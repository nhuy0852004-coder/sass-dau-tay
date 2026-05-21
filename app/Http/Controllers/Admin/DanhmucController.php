<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CapnhatdanhmucRequest;
use App\Http\Requests\Admin\ThemdanhmucRequest;
use App\Models\Danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhmucController extends Controller
{
    public function index(Request $request)
    {
        $tukhoa = trim($request->get('tukhoa', ''));
        $trangthai = $request->get('trangthai', '');

        $danhsachDanhmuc = Danhmuc::query()
            ->withCount('sanpham')
            ->when($tukhoa !== '', function ($query) use ($tukhoa) {
                $query->where(function ($subQuery) use ($tukhoa) {
                    $subQuery->where('tendanhmuc', 'like', '%' . $tukhoa . '%')
                        ->orWhere('mota', 'like', '%' . $tukhoa . '%');
                });
            })
            ->when(in_array($trangthai, ['hien', 'an']), function ($query) use ($trangthai) {
                $query->where('trangthai', $trangthai);
            })
            ->orderBy('thutu')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $trangThaiDanhmuc = [
            'hien' => [
                'ten' => 'Đang hiển thị',
                'class' => 'badge-success',
            ],
            'an' => [
                'ten' => 'Đang ẩn',
                'class' => 'badge-muted',
            ],
        ];

        return view('admin.danhmuc.index', compact(
            'danhsachDanhmuc',
            'trangThaiDanhmuc',
            'tukhoa',
            'trangthai'
        ));
    }

    public function store(ThemdanhmucRequest $request)
    {
        $dulieu = $request->validated();

        $dulieu['slug'] = $this->taoSlugDuyNhat($dulieu['tendanhmuc']);

        Danhmuc::create($dulieu);

        return redirect()
            ->route('admin.danhmuc.index')
            ->with('thanhcong', 'Thêm danh mục thành công.');
    }

    public function update(CapnhatdanhmucRequest $request, Danhmuc $danhmuc)
    {
        $dulieu = $request->validated();

        $dulieu['slug'] = $this->taoSlugDuyNhat($dulieu['tendanhmuc'], $danhmuc->id);

        $danhmuc->update($dulieu);

        return redirect()
            ->route('admin.danhmuc.index')
            ->with('thanhcong', 'Cập nhật danh mục thành công.');
    }

    public function destroy(Danhmuc $danhmuc)
    {
        $danhmuc->loadCount('sanpham');

        if ($danhmuc->sanpham_count > 0) {
            return redirect()
                ->route('admin.danhmuc.index')
                ->with('loi', 'Không thể xóa danh mục đang có sản phẩm.');
        }

        $danhmuc->delete();

        return redirect()
            ->route('admin.danhmuc.index')
            ->with('thanhcong', 'Xóa danh mục thành công.');
    }

    public function doiTrangThai(Danhmuc $danhmuc)
    {
        $danhmuc->update([
            'trangthai' => $danhmuc->trangthai === 'hien' ? 'an' : 'hien',
        ]);

        return redirect()
            ->route('admin.danhmuc.index')
            ->with('thanhcong', 'Cập nhật trạng thái danh mục thành công.');
    }

    private function taoSlugDuyNhat(string $tenDanhmuc, ?int $idBoQua = null): string
    {
        $slugGoc = Str::slug($tenDanhmuc);

        if ($slugGoc === '') {
            $slugGoc = 'danh-muc';
        }

        $slug = $slugGoc;
        $dem = 1;

        while (
            Danhmuc::where('slug', $slug)
                ->when($idBoQua, function ($query) use ($idBoQua) {
                    $query->where('id', '!=', $idBoQua);
                })
                ->exists()
        ) {
            $slug = $slugGoc . '-' . $dem;
            $dem++;
        }

        return $slug;
    }
}
