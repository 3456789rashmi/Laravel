<!-- 
@include('common.header')
<h1>Home</h1>
<h1>Welcome {{$name}}</h1>
<h1>{{rand(1,100)}}</h1> 
  <h1>{{$users[1]}}</h1> 
  @if($name == 'das')
  <h1>Welcome {{$name}}</h1>
  @elseif($name=='waet')
  <h2>this is waet</h2>
  @else
  <h2>other use</h2>
  @endif
  <div>
    @foreach($users as $user)
    <h5>{{$user}}</h5>
    @endforeach
</div>
  <div>
    @for($i=0;$i<=10;$i++)
    <h3>{{$i}}</h3>
    @endfor
</div> -->
<x-messagebanner />
<h1>Home page</h1>
<style>
    .sucess{
        background-color:green;
        color:white;
        padding:10px;
        border-radius:5px;
        display:inline-block;
    }
</style>