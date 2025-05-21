<?php

@component('mail::message')
# Nieuw contactbericht

**Naam:** {{ $data['name'] }}  
**E-mail:** {{ $data['email'] }}  
**Onderwerp:** {{ $data['subject'] }}

**Bericht:**  
{{ $data['message'] }}

@endcomponent
