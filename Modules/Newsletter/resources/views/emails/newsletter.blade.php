<x-mail::message>
# Newsletter - {{ config('app.name') }}

You are now subscribed to our newsletter.

---

**Subscriber Details:**

- **Name:** {{ $content['name'] ?? 'N/A' }}
- **Email:** {{ $content['email'] ?? 'N/A' }}

---

<x-mail::button :url="$unsubscribeUrl">
Unsubscribe
</x-mail::button>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
