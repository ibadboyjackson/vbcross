@extends('layouts.app')
@section('title' , 'User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">User Details</div>

                    <div class="card-body">
                       <table>
                           <tr>
                               <td>Full Name: {{ $user->name }}</td>
                               <td>Email: {{ $user->email }}</td>
                               <td>Role: {{ $user->email }}</td>
                           </tr>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
