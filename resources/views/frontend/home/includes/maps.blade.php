<section id="maps">
    <div class="wrapper bg-light">
        <div class="container pb-5 pb-md-5">
            <div class="row mt-md-n50p mb-14 mb-md-7">
                <div class="col-xl-10 mx-auto">
                    <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-400"
                        data-image-src="{{ asset('assets/frontend') }}/img/photos/bg2.jpg"
                        style="background-image: url({{ asset('assets/frontend') }}/img/photos/bg2.jpg);">
                        <div class="card-body p-9 p-xl-11">
                            <div class="row align-items-center counter-wrapper gy-8 text-center text-white">
                                <div class="col-6 col-lg-3">
                                    <h3 class="counter counter-lg text-white" style="visibility: visible;">
                                        {{ education('Sarana Pendidikan')->latLng->count() }}
                                    </h3>
                                    <p>Sarana Pendidikan</p>
                                </div>
                                <!--/column -->
                                <div class="col-6 col-lg-3">
                                    <h3 class="counter counter-lg text-white" style="visibility: visible;">
                                        {{ education('Sarana Kesehatan')->latLng->count() }}
                                    </h3>
                                    <p>Sarana Kesehatan</p>
                                </div>
                                <!--/column -->
                                <div class="col-6 col-lg-3">
                                    <h3 class="counter counter-lg text-white" style="visibility: visible;">
                                        {{ education('Sarana Olahraga')->latLng->count() }}
                                    </h3>
                                    <p>Sarana Olahraga</p>
                                </div>
                                <!--/column -->
                                <div class="col-6 col-lg-3">
                                    <h3 class="counter counter-lg text-white" style="visibility: visible;">
                                        {{ education('Tempat Ibadah')->latLng->count() }}
                                    </h3>
                                    <p>Tempat Ibadah</p>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!-- /column -->
            </div>
            <div class="row">
                <div class="col mt-n14 mb-5">
                    <div class="card">
                        <div class="row ">
                            <div id="map" style="height: 700px;"
                                class="col-lg-12 map map-full rounded-top rounded-lg-start">

                            </div>
                            <!-- /.map -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
</section>
<!-- /section -->