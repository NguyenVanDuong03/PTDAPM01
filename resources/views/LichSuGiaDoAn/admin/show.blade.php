<!DOCTYPE html>
<html lang="en">

@section('content')
    <!-- BEGIN: Form -->
    <div class="col-8 col-md-10">
        <div class="mb-4">
            {{-- Thêm đường dẫn qua lại index --}}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h3 class="pt-3">
            Thông tin giá đồ ăn
        </h3>
        <form action="" class="d-grid gap-3 w-md-50 mx-auto">
            <div class="flex-column d-flex gap-2">
                <label for="ma-do-an">Tên đồ ăn*</label>
                <select class="form-select form-select-sm" aria-label="Small select example" id="ma-do-an" name="ma-do-an"
                    disabled="true">
                    <option selected>Tên đồ ăn</option>
                    <option value="1">One</option>
                </select>
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="thoi-gian">Thời gian tạo*</label>
                <input type="datetime" id="thoi-gian" name="thoi-gian" disabled="true" class="px-2 py-1">
            </div>
            <div class="flex-column d-flex gap-2">
                <label for="gia">Gia*</label>
                <input type="text" id="gia" name="gia" class="px-2 py-1" oninput="formatNumber(event)"
                    disabled="true">
            </div>

    </div>



    <script src={{ asset('asset/js/vendor.min.js') }}></script>
    <script src={{ asset('asset/js/script.js') }}></script>
    <script>
        function layNgayThangNamHienTai() {
            const ngayThangNam = new Date().toLocaleDateString(
                'vi-VN');
            return ngayThangNam;
        }
        document.getElementById('thoi-gian').value = layNgayThangNamHienTai();

        function formatNumber(event) {
            const input = event.target;
            const value = input.value.replace(/\D/g, '');

            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            input.value = formattedValue;
        }
    </script>
</body>

</html>
