<!-- 1. Update lại bố cục trang
Phần tiêu đề trang

Tiêu đề không nằm trong header.

Nằm ở phần nội dung:

Quản lý danh mục
Quản lý nhóm sản phẩm, trạng thái hiển thị và thứ tự sắp xếp trong hệ thống.

Bên phải tiêu đề có nút:

+ Thêm danh mục

Nút nằm ngang hàng với tiêu đề, không nằm trong bộ lọc. -->

<!-- 2. Update bộ lọc cho tự nhiên hơn

Bộ lọc sẽ nằm trong card riêng, gọn và ngang hàng.

Gồm:

Ô tìm kiếm
Lọc trạng thái
Nút Lọc
Nút Đặt lại

Thiết kế:

Từ khóa: rộng nhất
Trạng thái: vừa phải
Button: nằm bên phải -->

<!-- Không để bộ lọc bị cao, không bị nuốt chữ, không bị thừa khoảng trắng.

Trạng thái gồm:

Tất cả trạng thái
Đang hiển thị
Đang ẩn -->
3. Update bảng danh mục

Bảng sẽ đơn giản, dễ hiểu hơn.

Cột nên có:

Danh mục
Thứ tự
Sản phẩm
Trạng thái
Ngày tạo
Thao tác

Không hiển thị rối kiểu nhiều dòng khó hiểu.

Cột Danh mục hiển thị:

Tên danh mục
Mô tả ngắn bên dưới

Ví dụ:

Điện thoại
Các sản phẩm điện thoại, phụ kiện di động.

Nếu chưa có mô tả:

Chưa có mô tả
4. Update trạng thái thành badge đẹp hơn

Không dùng text thô.

Dùng badge:

Đang hiển thị  -> xanh nhẹ
Đang ẩn        -> xám nhẹ

Style badge phải đồng bộ với các trang sau:

Sản phẩm
Đơn hàng
Khách hàng
5. Update thao tác trong bảng

Mỗi dòng có 3 thao tác:

Ẩn / hiện
Sửa
Xóa

Dạng icon nhỏ, không dùng button chữ dài.

Ví dụ:

Icon mắt: Ẩn / hiện
Icon bút: Sửa
Icon thùng rác: Xóa

Khi xóa phải có confirm:

Bạn có chắc muốn xóa danh mục này không?

Nếu danh mục đang có sản phẩm thì không cho xóa:

Không thể xóa danh mục đang có sản phẩm.
6. Update modal thêm danh mục

Modal phải là hình chữ nhật ngang, rộng, không làm form hẹp dọc.

Kích thước:

Width: khoảng 980px - 1180px
Max height: theo màn hình
Body có scroll nếu nội dung dài

Form thêm gồm:

Tên danh mục
Thứ tự hiển thị
Trạng thái
Mô tả

Bố cục:

Hàng 1:
Tên danh mục | Thứ tự hiển thị

Hàng 2:
Trạng thái

Hàng 3:
Mô tả full ngang

Footer modal:

Hủy | Thêm danh mục
7. Update modal sửa danh mục

Modal sửa dùng cùng layout với modal thêm.

Nhưng title là:

Sửa danh mục

Nút submit:

Lưu thay đổi

Dữ liệu trong form phải tự fill theo danh mục đang sửa.

8. Validate tiếng Việt

Khi thêm/sửa phải validate rõ ràng:

Vui lòng nhập tên danh mục.
Tên danh mục không được vượt quá 180 ký tự.
Thứ tự hiển thị phải là số nguyên.
Thứ tự hiển thị không được nhỏ hơn 0.
Trạng thái danh mục không hợp lệ.
Mô tả không được vượt quá 500 ký tự.

Không cho lỗi tiếng Anh hiện ra giao diện.

9. Update empty state

Nếu chưa có danh mục thì hiện empty state đẹp:

Icon thư mục
Chưa có danh mục
Hãy tạo danh mục đầu tiên để bắt đầu quản lý sản phẩm trong hệ thống.
Nút: + Thêm danh mục

Không để bảng trống trắng xóa.

10. Update phân trang

Nếu nhiều danh mục thì dùng phân trang.

Phân trang nằm dưới bảng, trong cùng card.

Cần chỉnh CSS để phân trang Laravel không quá xấu.

Nên làm style:

Nút nhỏ
Bo góc nhẹ
Active màu xanh chính
Không đổ bóng mạnh
11. Update CSS riêng cho danh mục

Không viết CSS thẳng trong Blade.

Tạo file riêng:

public/assets/admin/css/danhmuc.css

CSS danh mục chỉ chứa:

filter-card
filter-form
category-info
pagination-wrap

Các phần dùng chung thì để ở file chung:

table.css
form.css
modal.css
button.css
badge.css
empty-state.css
12. Update JS dùng chung

File:

public/assets/admin/js/admin.js

Cần có logic dùng chung:

Mở modal
Đóng modal
Đóng modal khi bấm ESC
Đóng modal khi bấm nền đen
Confirm trước khi xóa
Loading nhẹ khi submit form

Không viết JS riêng lẻ trong từng Blade.

13. Update backend cho sạch

Danh mục sẽ dùng:

DanhmucController
ThemdanhmucRequest
CapnhatdanhmucRequest
Danhmuc model

Controller chỉ xử lý:

index
store
update
destroy
doiTrangThai

Không nhồi validate trong Controller.

Validate đưa vào Request.

14. Route cần có

Trong nhóm /admin và có middleware auth:

GET     /admin/danh-muc
POST    /admin/danh-muc
PUT     /admin/danh-muc/{danhmuc}
DELETE  /admin/danh-muc/{danhmuc}
PATCH   /admin/danh-muc/{danhmuc}/doi-trang-thai

Tên route:

admin.danhmuc.index
admin.danhmuc.store
admin.danhmuc.update
admin.danhmuc.destroy
admin.danhmuc.doitrangthai
15. Thứ tự triển khai update

Làm theo thứ tự này để ít lỗi:

1. Sửa route danh mục
2. Sửa DanhmucController
3. Tạo Form Request thêm/sửa
4. Sửa sidebar trỏ đúng route danh mục
5. Tạo view admin/danhmuc/index.blade.php
6. Update admin.js cho modal/confirm/loading
7. Update modal.css
8. Update form.css
9. Update table.css nếu cần
10. Tạo danhmuc.css
11. Import danhmuc.css vào admin.css
12. Clear cache
13. Test thêm/sửa/xóa/lọc/trạng thái
16. Tiêu chuẩn sau khi update xong

Trang danh mục đạt chuẩn khi:

Vào /admin/danh-muc không lỗi
Bấm thêm danh mục mở modal ngang
Thêm danh mục thành công
Sửa danh mục mở modal ngang và có sẵn dữ liệu
Ẩn/hiện danh mục hoạt động đúng
Xóa có confirm
Không cho xóa danh mục có sản phẩm
Tìm kiếm hoạt động
Lọc trạng thái hoạt động
Giao diện không bị vỡ trên mobile
Không có lỗi tiếng Anh ở validate
Không có CSS viết trong Blade
Kết luận hướng update

Trang Danh mục sẽ là module chuẩn mẫu cho toàn bộ Admin.

Sau khi update xong trang này, các trang sau chỉ cần bám theo:

Sản phẩm: dùng lại layout bảng + filter + modal ngang
Khách hàng: dùng lại form + badge + action
Đơn hàng: dùng lại table + trạng thái + detail
Cài đặt: dùng lại form ngang + card

Bước tiếp theo nên làm là viết full code update trang Danh mục theo kế hoạch này.
