@component('mail::message')
    # Автоматическое письмо для тестового задания

    **Имя:** {{ $contact->name }}
    **Телефон:** {{ $contact->phone }}
    **Email:** {{ $contact->email }}

@endcomponent

