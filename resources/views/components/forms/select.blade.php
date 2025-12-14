<div class="flex flex-col gap-y-2 mb-3 w-full">
    <label class="text-base text-gray-700" for="{{ $id }}">{{ $label }}</label>

    <select id="{{ $id }}" name="{{ $name }}" class="select w-full @error($name) select-error @enderror"
        {{ $isRequired ? 'required' : '' }}>
        <option value="" disabled {{ old($name, $name) ? '' : 'selected' }}>
            Pilih {{ $label }}
        </option>
        @foreach ($options as $option)
            <option value="{{ $option['id'] }}" {{ (string) $value === (string) $option['id'] ? 'selected' : '' }}>
                {{ $option['name'] }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
