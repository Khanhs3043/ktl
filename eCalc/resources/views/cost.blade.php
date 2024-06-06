@extends('template')
@section('content')
<div class="container">
       
        <p class="result main-title">Giá điện hiện tại</p>
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
                <td>{{$l1}}</td>
                <td>{{$l1*$c1}}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 2</td>
                <td>{{$c2}}</td>
                <td>{{$l2}}</td>
                <td>{{$l2*$c2}}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 3</td>
                <td>{{$c3}}</td>
                <td>{{$l3}}</td>
                <td>{{$l3*$c3}}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 4</td>
                <td>{{$c4}}</td>
                <td>{{$l4}}</td>
                <td>{{$l4*$c4}}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 5</td>
                <td>{{$c5}}</td>
                <td>{{$l5}}</td>
                <td>{{$l5*$c5}}</td>
            </tr>
            <tr>
                <td class="td1">Bậc thang 6</td>
                <td>{{$c6}}</td>
                <td>{{$l6}}</td>
                <td>...</td>
            </tr>
        </table>
        
    </div>
@endsection
