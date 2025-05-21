
@component('mail::message')
# Nieuw contactbericht

**Naam:** {{ $data['name'] }}  
**E-mail:** {{ $data['email'] }}  

**Bericht:**  
{{ $data['message'] }}

@endcomponent
