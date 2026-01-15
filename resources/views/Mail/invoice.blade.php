<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
@font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

* {
  box-sizing: border-box;
}

body {
  width: 21cm;
  min-height: 29.7cm;
  margin: 0 auto;
  padding: 20px 30px;
  font-family: SourceSansPro, Arial, sans-serif;
  font-size: 13px;
  color: #555;
  background: #fff;
}

/* Header */
header {
  padding-bottom: 15px;
  margin-bottom: 30px;
  border-bottom: 2px solid #0087C3;
}

#logo img {
  height: 60px;
}

#company h2 {
  margin: 0;
  font-size: 18px;
}

/* Client & Invoice Info */
#details {
  margin-bottom: 35px;
}

#client {
  float: left;
  width: 48%;
  padding-left: 10px;
  border-left: 5px solid #0087C3;
}

#invoice {
  float: right;
  width: 48%;
  text-align: right;
}

#invoice h1 {
  font-size: 26px;
  margin: 0 0 8px;
  color: #0087C3;
}

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

table th {
  padding: 12px;
  background: #f3f3f3;
  font-size: 12px;
  text-align: center;
}

table td {
  padding: 12px;
  font-size: 13px;
  background: #fafafa;
  border-bottom: 1px solid #e0e0e0;
}

table .desc {
  text-align: left;
}

table .no {
  background: #57B223;
  color: #fff;
  font-weight: bold;
}

table .total {
  background: #57B223;
  color: #fff;
  font-weight: bold;
}

table tfoot td {
  background: #fff;
  font-size: 13px;
  border: none;
}

table tfoot tr:last-child td {
  font-size: 16px;
  font-weight: bold;
  color: #57B223;
  border-top: 2px solid #57B223;
}

/* Thank you & notice */
#thanks {
  font-size: 22px;
  margin-bottom: 20px;
}

#notices {
  padding-left: 10px;
  border-left: 5px solid #0087C3;
}

/* Footer */
footer {
  position: absolute;
  bottom: 20px;
  left: 0;
  right: 0;
  text-align: center;
  font-size: 11px;
  color: #777;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">www.kumofashion.com</h2>
        <div>MIrpur-10,Dhaka</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">kumofashion@gmail.com</a></div>
      </div>
      </div>
    </header>
    @php
    $order = App\Models\Order::where('order_id',$order_id)->first();
    $products = App\Models\OrderProduct::where('order_id',$order_id)->get();
    @endphp
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h3 class="name">{{ $order->name }} </h3>
          <div class="address">{{ $order->address }}, {{ $order->rel_to_city->name }},{{ $order->rel_to_country->name }}</div>
          <div class="email"><a href="mailto:john@example.com">{{ $order->email }}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE ID -{{ $order_id }}</h1>
          <div class="date">Date of Invoice:{{ $order->created_at->format('d-m-Y') }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $index=>$pro)
          <tr>
            <td class="no">{{ $index+1 }}</td>
            <td class="desc">{{ $pro->rel_to_product->product_name }}</td>
            <td class="unit">&#2547;{{ $pro->price }}</td>
            <td class="qty">{{ $pro->quantity }}</td>
            <td class="total">&#2547;{{$pro->price *  $pro->quantity }}</td>
          </tr>
           @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>{{ $order->total + $order->discount - $order->charge  }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">CHARGE</td>
            <td>{{ $order->charge }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">DISCOUNT</td>
            <td>{{ $order->discount }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>{{ $order->total }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
