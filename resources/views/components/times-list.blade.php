@props(['data'])

@php
    $time = old($data) ?? ($data ?? '');
@endphp

<option value="00:00" {{ $time == '00:00' ? 'selected' : '' }}>00:00</option>
<option value="01:00" {{ $time == '01:00' ? 'selected' : '' }}>01:00</option>
<option value="02:00" {{ $time == '02:00' ? 'selected' : '' }}>02:00</option>
<option value="03:00" {{ $time == '03:00' ? 'selected' : '' }}>03:00</option>
<option value="04:00" {{ $time == '04:00' ? 'selected' : '' }}>04:00</option>
<option value="05:00" {{ $time == '05:00' ? 'selected' : '' }}>05:00</option>
<option value="06:00" {{ $time == '06:00' ? 'selected' : '' }}>06:00</option>
<option value="07:00" {{ $time == '07:00' ? 'selected' : '' }}>07:00</option>
<option value="08:00" {{ $time == '08:00' ? 'selected' : '' }}>08:00</option>
<option value="09:00" {{ $time == '09:00' ? 'selected' : '' }}>09:00</option>
<option value="10:00" {{ $time == '10:00' ? 'selected' : '' }}>10:00</option>
<option value="11:00" {{ $time == '11:00' ? 'selected' : '' }}>11:00</option>
<option value="12:00" {{ $time == '12:00' ? 'selected' : '' }}>12:00</option>
<option value="13:00" {{ $time == '13:00' ? 'selected' : '' }}>13:00</option>
<option value="14:00" {{ $time == '14:00' ? 'selected' : '' }}>14:00</option>
<option value="15:00" {{ $time == '15:00' ? 'selected' : '' }}>15:00</option>
<option value="16:00" {{ $time == '16:00' ? 'selected' : '' }}>16:00</option>
<option value="17:00" {{ $time == '17:00' ? 'selected' : '' }}>17:00</option>
<option value="18:00" {{ $time == '18:00' ? 'selected' : '' }}>18:00</option>
<option value="19:00" {{ $time == '19:00' ? 'selected' : '' }}>19:00</option>
<option value="20:00" {{ $time == '20:00' ? 'selected' : '' }}>20:00</option>
<option value="21:00" {{ $time == '21:00' ? 'selected' : '' }}>21:00</option>
<option value="22:00" {{ $time == '22:00' ? 'selected' : '' }}>22:00</option>
<option value="23:00" {{ $time == '23:00' ? 'selected' : '' }}>23:00</option>