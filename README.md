# Problem Details for HTTP APIs

A lightweight PHP implementation of **[RFC 7807](https://www.rfc-editor.org/rfc/rfc7807)** and **[RFC 9457](https://www.rfc-editor.org/rfc/rfc9457.html)** for representing HTTP API errors.

## Usage

```php
use Yamous\ProblemDetailsApi\ProblemDetails;

$problem = new ProblemDetails(
    status: 404,
    title: 'Not Found',
    detail: 'User not found'
);

echo json_encode($problem);
```

Output:

```json
{
  "type": "about:blank",
  "title": "Not Found",
  "status": 404,
  "detail": "User not found"
}
```

---

## Extensions

You can add custom fields using extensions:

```php
$problem = new ProblemDetails(
    status: 400,
    detail: 'Validation failed',
    extensions: [
        'errors' => [
            'email' => 'Invalid email address'
        ]
    ]
);
```

---

## Validation

The library performs minimal validation:

* `status` must be between 100 and 599
* extension keys cannot override standard fields

---

## JSON Serialization

The object implements `JsonSerializable`, so it can be directly encoded.

---

## Inspiration

This package has been inspired by this [API Platform Conference 2025 talk](https://www.youtube.com/watch?v=VVsbgWIUBWs) (in French).

---

## License

MIT