@extends('admin.layouts.app')

@section('tieude', 'Quản lý danh mục')
@section('tieudetrang', 'Quản lý danh mục')
@section('mota', 'Quản lý nhóm sản phẩm, trạng thái hiển thị và thứ tự sắp xếp trong hệ thống.')

@section('noidung')
    <div class="content-card filter-card">
        <form method="GET" action="{{ route('admin.danhmuc.index') }}" class="filter-form">
            <div class="filter-group filter-search">
                <label class="form-label" for="tukhoa">Từ khóa</label>

                <div class="input-with-icon">
                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="tukhoa"
                        name="tukhoa"
                        class="form-control"
                        value="{{ $tukhoa }}"
                        placeholder="Tìm theo tên hoặc mô tả..."
                    >
                </div>
            </div>

            <div class="filter-group filter-status">
                <label class="form-label" for="trangthai">Trạng thái</label>

                <div class="select-wrap">
                    <select id="trangthai" name="trangthai" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="hien" {{ $trangthai === 'hien' ? 'selected' : '' }}>
                            Đang hiển thị
                        </option>
                        <option value="an" {{ $trangthai === 'an' ? 'selected' : '' }}>
                            Đang ẩn
                        </option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-primary">
                    <i class="bi bi-funnel"></i>
                    Lọc
                </button>

                <a href="{{ route('admin.danhmuc.index') }}" class="btn-light">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Đặt lại
                </a>

                <button type="button" class="btn-primary btn-add-category" data-modal-target="modalThemDanhMuc">
                    <i class="bi bi-plus-lg"></i>
                    Thêm danh mục
                </button>
            </div>
        </form>
    </div>

    <div class="content-card">
        @if ($danhsachDanhmuc->count())
            <div class="table-wrapper">
                <table class="admin-table category-table">
                    <thead>
                        <tr>
                            <th>Danh mục</th>
                            <th>Thứ tự</th>
                            <th>Sản phẩm</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhsachDanhmuc as $danhmuc)
                            <tr>
                                <td>
                                    <div class="category-info">
                                        <strong>{{ $danhmuc->tendanhmuc }}</strong>

                                        @if ($danhmuc->mota)
                                            <span>{{ $danhmuc->mota }}</span>
                                        @else
                                            <span class="text-muted">Chưa có mô tả</span>
                                        @endif
                                    </div>
                                </td>

                                <td><span class="table-number">{{ number_format($danhmuc->thutu, 0, ',', '.') }}</span></td>
                                <td><span class="table-number">{{ number_format($danhmuc->sanpham_count, 0, ',', '.') }} sản phẩm</span></td>
                                <td><span class="table-date">{{ optional($danhmuc->ngaytao)->format('d/m/Y H:i') }}</span></td>

                                <td>
                                    <div class="table-actions">
                                        <form method="POST" action="{{ route('admin.danhmuc.doitrangthai', $danhmuc) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="status-action-button {{ $danhmuc->trangthai === 'hien' ? 'is-active' : 'is-hidden' }}"
                                                title="{{ $danhmuc->trangthai === 'hien' ? 'Bấm để ẩn danh mục' : 'Bấm để hiển thị danh mục' }}"
                                            >
                                                <span></span>
                                                {{ $danhmuc->trangthai === 'hien' ? 'Đang hiển thị' : 'Đang ẩn' }}
                                            </button>
                                        </form>

                                        <button
                                            type="button"
                                            class="btn-icon"
                                            title="Sửa danh mục"
                                            data-modal-target="modalSuaDanhMuc{{ $danhmuc->id }}"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.danhmuc.destroy', $danhmuc) }}"
                                            class="form-can-xac-nhan"
                                            data-message="Bạn có chắc muốn xóa danh mục này không?"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-icon danger" title="Xóa danh mục">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                {{ $danhsachDanhmuc->links() }}
            </div>

            @foreach ($danhsachDanhmuc as $danhmuc)
                <div class="modal-backdrop-custom" id="modalSuaDanhMuc{{ $danhmuc->id }}">
                    <div class="admin-modal large">
                        <form method="POST" action="{{ route('admin.danhmuc.update', $danhmuc) }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-header-custom">
                                <div>
                                    <h3 class="modal-title-custom">Sửa danh mục</h3>
                                    <p class="modal-description">Cập nhật thông tin danh mục sản phẩm.</p>
                                </div>

                                <button type="button" class="modal-close" data-modal-close>
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>

                            <div class="modal-body-custom">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Tên danh mục</label>
                                        <input type="text" name="tendanhmuc" class="form-control" value="{{ old('tendanhmuc', $danhmuc->tendanhmuc) }}" placeholder="Ví dụ: Điện thoại">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Thứ tự hiển thị</label>
                                        <input type="number" name="thutu" class="form-control" value="{{ old('thutu', $danhmuc->thutu) }}" min="0" placeholder="Ví dụ: 1">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Trạng thái</label>

                                        <div class="status-choice-group">
                                            <label class="status-choice">
                                                <input
                                                    type="radio"
                                                    name="trangthai"
                                                    value="hien"
                                                    {{ old('trangthai', $danhmuc->trangthai) === 'hien' ? 'checked' : '' }}
                                                >
                                                <span>
                                                    <i class="bi bi-check-circle"></i>
                                                    Đang hiển thị
                                                </span>
                                            </label>

                                            <label class="status-choice">
                                                <input
                                                    type="radio"
                                                    name="trangthai"
                                                    value="an"
                                                    {{ old('trangthai', $danhmuc->trangthai) === 'an' ? 'checked' : '' }}
                                                >
                                                <span>
                                                    <i class="bi bi-eye-slash"></i>
                                                    Đang ẩn
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group full">
                                        <label class="form-label">Mô tả</label>
                                        <textarea name="mota" class="form-textarea" placeholder="Nhập mô tả ngắn cho danh mục...">{{ old('mota', $danhmuc->mota) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-custom">
                                <button type="button" class="btn-light" data-modal-close>Hủy</button>
                                <button type="submit" class="btn-primary">
                                    <i class="bi bi-check2"></i>
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>

                <h4>Chưa có danh mục</h4>
                <p>Hãy tạo danh mục đầu tiên để bắt đầu quản lý sản phẩm trong hệ thống.</p>

                <button type="button" class="btn-primary" data-modal-target="modalThemDanhMuc">
                    <i class="bi bi-plus-lg"></i>
                    Thêm danh mục
                </button>
            </div>
        @endif
    </div>

    <div class="modal-backdrop-custom" id="modalThemDanhMuc">
        <div class="admin-modal large">
            <form method="POST" action="{{ route('admin.danhmuc.store') }}">
                @csrf

                <div class="modal-header-custom">
                    <div>
                        <h3 class="modal-title-custom">Thêm danh mục</h3>
                        <p class="modal-description">Tạo nhóm sản phẩm mới để quản lý hàng hóa dễ hơn.</p>
                    </div>

                    <button type="button" class="modal-close" data-modal-close>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" name="tendanhmuc" class="form-control" value="{{ old('tendanhmuc') }}" placeholder="Ví dụ: Điện thoại">
                            @error('tendanhmuc')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Thứ tự hiển thị</label>
                            <input type="number" name="thutu" class="form-control" value="{{ old('thutu', 0) }}" min="0" placeholder="Ví dụ: 1">
                            @error('thutu')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Trạng thái</label>

                            <div class="status-choice-group">
                                <label class="status-choice">
                                    <input
                                        type="radio"
                                        name="trangthai"
                                        value="hien"
                                        {{ old('trangthai', 'hien') === 'hien' ? 'checked' : '' }}
                                    >
                                    <span>
                                        <i class="bi bi-check-circle"></i>
                                        Đang hiển thị
                                    </span>
                                </label>

                                <label class="status-choice">
                                    <input
                                        type="radio"
                                        name="trangthai"
                                        value="an"
                                        {{ old('trangthai') === 'an' ? 'checked' : '' }}
                                    >
                                    <span>
                                        <i class="bi bi-eye-slash"></i>
                                        Đang ẩn
                                    </span>
                                </label>
                            </div>

                            @error('trangthai')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Mô tả</label>
                            <textarea name="mota" class="form-textarea" placeholder="Nhập mô tả ngắn cho danh mục...">{{ old('mota') }}</textarea>
                            @error('mota')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer-custom">
                    <button type="button" class="btn-light" data-modal-close>Hủy</button>
                    <button type="submit" class="btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Thêm danh mục
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
