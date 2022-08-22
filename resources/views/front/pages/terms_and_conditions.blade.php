@extends('front.layouts.master')
@section('content')
    <div class="terms-conditions-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-wrap">
                        @if(isset($terms_and_conditions))
                            {!! $terms_and_conditions->terms_and_condition !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
