<label class="form-check form-switch form-check-custom form-check-solid">
    <input class="form-check-input checkbox-is-active" type="checkbox" data-url="{{ route('admin.products.update', $id) }}" data-value="{{ $is_active }}" @if($is_active) checked @endif>
</label>
