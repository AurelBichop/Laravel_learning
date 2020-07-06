@extends('layouts.instructor-app')

@section('content')

<section class="contact-from-section spad">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-10 jumbotron">
                <h3 class="mb-5">Participants</h3>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Inscription</th>
                        <th scope="col">Participant</th>
                        <th scope="col">Cours</th>
                        <th scope="col">Prix payé</th>
                        <th scope="col">Votre revenu</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $particpant)
                            <tr>
                              <th>{{$particpant->created_at}}</th>
                              <td>{{$particpant->email}}</td>
                              <td>{{$particpant->course->title}}</td>
                              <td>{{$particpant->amount}}</td>
                              <td>{{$particpant->instructor_part}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</section>

@endsection
