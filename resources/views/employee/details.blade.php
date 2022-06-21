@extends('includes.layout')
  @section('title', 'Details | Employee')
  @section('content')
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee Details</li>
        </ol>

        <!-- Page Content -->
        <p>First Name : {{ $results->fname }}</p>
        <p>Last Name : {{ $results->lname }}</p>
        <p>E-mail : {{ $results->email }}</p>
        <p>Address Line 1 : {{ $results->addr1 }}</p>
        <p>Address Line 2 : {{ $results->addr2 }}</p>
        <p>City : {{ $results->city }}</p>
        <p>State : {{ $results->state }}</p>
        <p>Zip : {{ $results->zip }}</p>
        <p>Contact Number : {{ $results->contact_no }}</p>
        <p>Date of Birth : {{ $results->dob }}</p>
        <p>Date of Joining : {{ $results->doj }}</p>
        <p>Document Attached : </p> <br>
        @foreach($documents as $document)
          <img src="../images/{{ $document->file }}" alt="" style="height: 250px; width: 250px; margin: 10px;">
        @endforeach
      </div>
      @include('footer')
    </div>
  @endsection
