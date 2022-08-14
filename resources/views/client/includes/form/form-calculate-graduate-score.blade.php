<form action="GET" data-form="calculate-setting-score">
    <label for="{{ $prefix }}-to-hop">Chọn tổ hợp môn thi</label>
    <select data-input-type="khoithi" class="form-control shadow-none">
        <option selected value="khtn">Khoa học tự nhiên (KHTN)</option>
        <option value="khxh">Khoa học xã hội (KHXH)</option>
    </select>
</form>
<form action="GET" data-form="calculate-graduate-score">
    {{-- Group 1 --}}
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-toan">Toán</label>
                <input data-input-score="toan" name="toanScore" id="{{ $prefix }}-toan" type="number" class="form-control shadow-none" placeholder="Điểm môn Toán">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-van">Văn</label>
                <input data-input-score="van" name="vanScore" id="{{ $prefix }}-van" type="number" class="form-control shadow-none" placeholder="Điểm môn Ngữ văn">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-ngoai-ngu">Ngoại ngữ</label>
                <input data-input-score="ngoai-ngu" name="ngoainguScore" id="{{ $prefix }}-ngoai-ngu" {{ $prefix === 'gdtx' ? 'disabled' : '' }} type="number" class="form-control shadow-none" placeholder="Điểm môn Ngoại ngữ">
            </div>
        </div>
    </div>
    {{-- Group 2 --}}
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-mon-1-tohop">Môn 1 tổ hợp</label>
                <input data-input-score="mon-1-tohop" name="mon1tohopScore" id="{{ $prefix }}-mon-1-tohop" type="number" class="form-control shadow-none" placeholder="Điểm môn 1 tổ hợp KHTN/KHXH">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-mon-2-tohop">Môn 2 tổ hợp</label>
                <input data-input-score="mon-2-tohop" name="mon2tohopScore" id="{{ $prefix }}-mon-2-tohop" type="number" class="form-control shadow-none" placeholder="Điểm môn 2 tổ hợp KHTN/KHXH">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-mon-3-tohop">Môn 3 tổ hợp</label>
                <input data-input-score="mon-3-tohop" name="mon3tohopScore" id="{{ $prefix }}-mon-3-tohop" type="number" class="form-control shadow-none" placeholder="Điểm môn 3 tổ hợp KHTN/KHXH">
            </div>
        </div>
    </div>
    {{-- Group 3 --}}
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-tb-cn-12">TB cả năm lớp 12</label>
                <input data-input-score="tb-cn-12" name="cn12Score" id="{{ $prefix }}-tb-cn-12" type="number" class="form-control shadow-none" placeholder="Điểm trung bình cả năm lớp 12">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-khuyen-khich">Khuyến khích</label>
                <input data-input-score="khuyen-khich" name="khuyenkhichScore" id="{{ $prefix }}-khuyen-khich" type="number" class="form-control shadow-none" placeholder="Điểm khuyến khích">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="{{ $prefix }}-uu-tien">Ưu tiên</label>
                <input data-input-score="uu-tien" name="uutienScore" id="{{ $prefix }}-uu-tien" type="number" class="form-control shadow-none" placeholder="Điểm ưu tiên">
            </div>
        </div>
    </div>
    {{-- Group Button --}}
    <div class="d-flex justify-content-end">
        <button type="button" data-button="reset" class="btn btn-outline-secondary shadow-none mr-3">Làm mới</button>
        <button type="submit" class="btn btn-app shadow-none">Tính điểm</button>
    </div>
</form>
