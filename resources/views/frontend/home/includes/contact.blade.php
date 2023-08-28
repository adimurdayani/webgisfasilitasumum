<section id="contact">
    <div class="wrapper bg-light">
        <div class="container py-5 py-md-5">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7">
                    <figure><img class="w-auto" src="{{ asset('assets/frontend') }}/img/illustrations/i5.png"
                            srcset="{{ asset('assets/frontend') }}/img/illustrations/i5@2x.png 2x" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h2 class="fs-15 text-uppercase text-line text-primary text-center mb-3">Tempat Penelitian</h2>
                    <h3 class="display-5 mb-7">Kontak Peneliti.</h3>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-4 mt-n1">
                                <i class="uil uil-location-pin-alt"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">{{__('Address')}}</h5>
                            <address>{{ setting(1)->address }}</address>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-4 mt-n1">
                                <i class="uil uil-phone-volume"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">{{ __('Phone') }}</h5>
                            <p>{{ setting(1)->phone }}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">E-mail</h5>
                            <p class="mb-0">
                                <a href="mailto:{{ setting(1)->email }}" class="link-body">
                                    {{setting(1)->email }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /section -->