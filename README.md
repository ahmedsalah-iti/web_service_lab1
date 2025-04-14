# PHP Request Handler

A simple PHP request handler that lets you switch between **Curl** and **Guzzle** by editing one line in the code.

---

## 🔧 How to Switch Between Curl and Guzzle

Open the following file:

```
./classes/Request.php
```

### ✅ To use **Guzzle**:

Make sure this line is **active**:

```php
class Request extends GuzzleRequest {
```

And this line is **commented out**:

```php
// class Request extends CurlRequest {
```

---

### ✅ To use **Curl**:

Make sure this line is **active**:

```php
class Request extends CurlRequest {
```

And this line is **commented out**:

```php
// class Request extends GuzzleRequest {
```

---