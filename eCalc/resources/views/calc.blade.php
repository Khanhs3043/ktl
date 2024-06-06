@extends('template')
@section('content')
<div class="container">
        <div class="wrap1">
            <p class="title1 main-title">Nhập các thông số</p>
            <form action="/calc" method="POST" class="mform">
            @csrf
                <div class="label1">
                    <p>Số điện (kWh)</p>
                    <input type="number" class="kwh" name="kWh">
                </div>
                <button class="calc-btn" type = "submit">Tính toán</button>
            </form>
        </div>
        <p class="result main-title">Kết quả</p>
        <table class="result-tbl">
            <tr>
                <th></th>
                <th>Đơn giá<br>(đồng/kWh)</th>
                <th>Sản lượng <br>(kWh)</th>
                <th>Thành tiền <br>(đồng)</th>
            </tr>
            <tr>
                <td class="td1">Bậc thang 1</td>
                <td>{{$c1}}</td>
                <td>{{ isset($l1) ? $l1 : '0' }}</td>
                <td>{{ isset($l1) ? $l1*$c1 : '0' }}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 2</td>
                <td>{{$c2}}</td>
                <td>{{ isset($l2) ? $l2 : '0' }}</td>
                <td>{{ isset($l2) ? $l2*$c2 : '0' }}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 3</td>
                <td>{{$c3}}</td>
                <td>{{ isset($l3) ? $l3 : '0' }}</td>
                <td>{{ isset($l3) ? $l3*$c3 : '0' }}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 4</td>
                <td>{{$c4}}</td>
                <td>{{ isset($l4) ? $l4 : '0' }}</td>
                <td>{{ isset($l4) ? $l4*$c4 : '0' }}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 5</td>
                <td>{{$c5}}</td>
                <td>{{ isset($l5) ? $l5 : '0' }}</td>
                <td>{{ isset($l5) ? $l5*$c5 : '0' }}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 6</td>
                <td>{{$c6}}</td>
                <td>{{ isset($l6) ? $l6 : '0' }}</td>
                <td>{{ isset($l6) ? $l6*$c6 : '0' }}</td>
            </tr>
        </table>
        <p class="final main-title">Thành tiền</p>
        <div class="wrap2">
            <div class="left">
                <p class="ecost">Tiền điện</p>
                <p class="tax">Thuế GTGT (10%)</p>
                <p class="total">Tổng cộng tiền thanh toán</p>
            </div>
            <div class="right">
                <p class="pleft">{{ isset($cost) ? $cost : '0' }}</p>
                <p class="pleft">{{ isset($tax) ? $tax : '0' }}</p>
                <p class="pleft ptotal">{{ isset($total) ? $total : '0' }}</p>
            </div>
        </div>
        
    
       
      
        
    </div>
@endsection

