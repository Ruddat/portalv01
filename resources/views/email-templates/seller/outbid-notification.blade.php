<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bid Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ff6600;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #ff6600;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            background-color: #e65c00;
        }
        .rocket {
            display: block;
            margin: 20px auto;
            width: 50px;
            height: 50px;
            background: url('https://img.icons8.com/ios/452/rocket.png') no-repeat center center;
            background-size: contain;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your bid has been outbid!</h1>
        <div class="rocket"></div>
        <p><strong>Shop:</strong> {{ $shop_title }}</p>
        <p><strong>Owner:</strong> {{ $shop_owner }}</p>
        <p><strong>Original Rank:</strong> {{ $original_rank }}</p>
        <p><strong>New Rank:</strong> {{ $new_rank }}</p>
        <p><strong>Original Price:</strong> {{ $original_price }}</p>
        <p><strong>New Price:</strong> {{ $new_price }}</p>
        <p><a href="{{ route('increaseBid', ['shop_id' => $shop, 'current_price' => $new_price]) }}" class="button">Increase Bid</a></p>
        <div class="footer">
            <p>Thank you for using our service!</p>
        </div>
    </div>
</body>
</html>
