<div class="form-group">
    <label for="birthday">{{ $label }}</label>
    <div class="d-flex">
        <select name="dob" id="dob" class="form-control shadow-none mr-2">
            <option value="">Ngày</option>
            @for($i = 1; $i <= 31; $i++)
            <option {{ (int) $dayValue === $i ? 'selected' : '' }} value={{ $i }}>{{ $i }}</option>
            @endfor
        </select>
        <select name="mob" id="mob" class="form-control shadow-none mr-2">
            <option value="">Tháng</option>
            @for($i = 1; $i <= 12; $i++)
            <option {{ (int) $monthValue === $i ? 'selected' : '' }} value={{ $i }}>{{ $i }}</option>
            @endfor
        </select>
        <select name="yob" id="yob" class="form-control shadow-none">
            @php
            $currYear = date("Y");
            @endphp
            <option value="">Năm</option>
            @for($i = $currYear; $i >= $currYear-100; $i--)
            <option {{ (int) $yearValue === $i ? 'selected' : '' }} value={{ $i }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
    @if(count($errors))
    @php
    $errors = array_map('unserialize', array_unique(array_map('serialize', $errors->messages())));
    @endphp
    <ul>
        @foreach ($errors as $error)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $error[0] }}</strong>
        </span>
        @endforeach
    </ul>
    @endif
</div>
