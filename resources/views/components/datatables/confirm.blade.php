@props([
'action', 'method',
'button-class', 'button-title',
'message', 'icon',
'confirm-text', 'confirm-class',
'cancel-text', 'cancel-class'
])
<form method="POST" action="{{ $action }}" name="confirm-action"
      data-confirm-text="{{$confirmText }}" data-confirm-class="{{ $confirmClass }}"
      data-cancel-text="{{ $cancelText }}" data-cancel-class="{{ $cancelClass }}"
      data-icon="{{ $icon }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="_method" value="{{ $method }}">

    <button type="submit" class="{{ $buttonClass }}"data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $buttonTitle }}" >
        {{ $slot }}
    </button>
</form>
