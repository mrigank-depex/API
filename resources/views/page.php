<!DOCTYPE html>
<html>
<head>
    <title>Send OTP</title>
</head>
<body>
    <form action="/send-otp" method="GET">
        @csrf
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone">
        <button type="submit">Send OTP</button>
    </form>
</body>
</html>
