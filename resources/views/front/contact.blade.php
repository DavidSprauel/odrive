@extends('front.template.template')

@section('title')
    Nous contacter
@stop

@section('content')

    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Nous contacter</h1>
        </div>
    </section>

    <section class="contact-section">
        <div class="auto-container">
            <!--Section Title-->
            <div class="sec-title-one">
                <h2>Laissez nous un message ici</h2>
            </div>

            <div class="contact-form default-form">
                <form method="post" action="sendemail.php" id="contact-form">
                    <div class="row clearfix">

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="firstname" value="" placeholder="Prénom *">
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="lastname" value="" placeholder="Nom *">
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email" value="" placeholder="Email *">
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="subject" value="" placeholder="Sujet *">
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <textarea name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center">
                                <button type="submit" class="theme-btn btn-style-one">
                                    Envoyer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="info-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Info Column-->
                <div class="info-column col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="column-header"><h3>Adresse</h3></div>
                    <div class="info-box">
                        <div class="inner">
                            <div class="icon"><span class="flaticon-placeholder"></span></div>
                            <h4>Adresse</h4>
                            <div class="text">44 New Design Street, Down Town,  Melbourne 005</div>
                        </div>
                    </div>
                </div>

                <!--Info Column-->
                <div class="info-column col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="column-header"><h3>Appelez Nous</h3></div>
                    <div class="info-box">
                        <div class="inner">
                            <div class="icon"><span class="flaticon-technology-4"></span></div>
                            <h4>Appelez nous</h4>
                            <div class="text">564-334-21-22-34 <br>664-334-21-22-34 </div>
                        </div>
                    </div>
                </div>

                <!--Info Column-->
                <div class="info-column col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="column-header"><h3>Ecrivez Nous</h3></div>
                    <div class="info-box">
                        <div class="inner">
                            <div class="icon"><span class="flaticon-envelope"></span></div>
                            <h4>Info Services</h4>
                            <div class="text">information@yourdomain.com</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@stop