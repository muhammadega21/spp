<div class="flex flex-col gap-y-2 mb-3 w-full">
    <label class="text-base text-gray-700" for="{{ $id }}">{{ $label }}</label>
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}"
        class="input w-full @error($name) input-error @enderror" placeholder="Masukkan {{ $label }}"
        value="{{ $value }}" {{ $isRequired ? 'required' : '' }} />
    @if ($errors->has($name))
        <p class="text-sm text-red-500">{{ $errors->first($name) }}</p>
    @endif
</div>
