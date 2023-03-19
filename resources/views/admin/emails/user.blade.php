

<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}



#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  color: white;
}
</style>
</head>
<body>

    @if($role == 1)
    <h4>Admin Registration</h4>
    @elseif($role == 2)
    <h4>RM Registration</h4>
    @elseif($role == 3)
    <h4>CA Registration</h4>
    @elseif($role == 4)
    <h4>Admin User Registration</h4>
    @endif
    
    <h4>Dear {{$name ?? ''}}</h4>

<table id="customers" style="width:40%;">

 
  <tr>
    <td>Email </td>
    <td>{{$email ?? ''}}</td>
   
  </tr>
  <tr>
    <td>Mobile</td>
    <td>{{$mobile ?? ''}}</td>
    
  </tr>
  <tr>
    <td>DOB</td>
    <td>Roland Mendel</td>
  
  </tr>
  <tr>
    <td>career Role</td>
    <td>
             @if($role == 1)
    Admin 
    @elseif($role == 2)
    RM 
    @elseif($role == 3)
    CA 
    @elseif($role == 4)
    Admin User 
    @elseif($role == 5)
         User 
    @elseif($role == 6)
     Salesman 
    @elseif($role == 8)
     Operations 
     @endif
    </td>
  
  </tr>
  <tr>
    <td>User Name</td>
    <td>{{$email ?? ''}}</td>
   
  </tr>
  <tr>
    <td>Password</td>
    <td>{{$show_password ?? ''}}</td>
  
  </tr>
  <tr>
 
</table>



