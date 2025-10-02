@props(['options'])

<div>
    <select {{ $attributes->merge(['class' => 'form-control']) }}>
        <option>-- Select an option --</option>
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>