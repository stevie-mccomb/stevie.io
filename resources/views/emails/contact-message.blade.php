<x-mail::message>
# Stevie.IO :: Contact Message

A contact message has been sent from a visitor on [https://stevie.io](https://stevie.io).

<x-mail::table>
|            |                  |
|:-----------|:-----------------|
| First Name | {{ $firstName }} |
| Last Name  | {{ $lastName }}  |
| Email      | {{ $email }}     |
@if (!empty($phone))
| Phone      | {{ $phone }}     |
@endif
</x-mail::table>

{{ $content }}
</x-mail::message>
