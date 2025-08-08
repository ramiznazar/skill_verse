@extends('website.layouts.main')
@section('content')
<div class="main-content">

            <!-- Section: inner-header -->
            <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('assets/website/images/bg/bg3.jpg') }}">
                <div class="container pt-70 pb-20">
                    <!-- Section Content -->
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="title text-white">FAQ</h2>
                                <ol class="breadcrumb text-left text-black mt-10">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    {{-- <li><a href="#">Pages</a></li> --}}
                                    <li class="active text-gray-silver">FAQs</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div id="accordion1" class="panel-group accordion">
                                <div class="panel">
                                    <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion11" class="active" aria-expanded="true"> <span class="open-sub"></span> <strong>Q. What do you mean by item and end product?</strong></a> </div>
                                    <div id="accordion11" class="panel-collapse collapse in" role="tablist" aria-expanded="true">
                                        <div class="panel-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dolor rerum enim doloremque iusto eos atque tempora dignissimos similique, quae, maxime sit accusantium delectus, maiores officiis vitae
                                                fuga sunt repellendus. Molestiae quae, ducimus ut tenetur nobis id quam autem quibusdam commodi inventore laborum libero officiis</p>
                                            <p>Accusantium a laboriosam cumque consequatur voluptates fuga assumenda corporis amet. Vitae placeat architecto ipsa cumque fugiat, atque molestiae perferendis quasi quaerat iste voluptate quas dicta corporis,
                                                incidunt quibusdam quia odit unde, rem harum quis! Optio debitis veniam quibusdam, culpa quia, aperiam cupiditate perspiciatis repellat similique saepe magnam quaerat iusto obcaecati doloremque, dolor praesentium.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion12" aria-expanded="false"> <span class="open-sub"></span> <strong>Q. What are some examples of permitted end products?</strong></a>                                        </div>
                                    <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dolor rerum enim doloremque iusto eos atque tempora dignissimos similique, quae, maxime sit accusantium delectus, maiores officiis vitae
                                                fuga sunt repellendus. Molestiae quae, ducimus ut tenetur nobis id quam autem quibusdam commodi inventore laborum libero officiis</p>
                                            <p>Accusantium a laboriosam cumque consequatur voluptates fuga assumenda corporis amet. Vitae placeat architecto ipsa cumque fugiat, atque molestiae perferendis quasi quaerat iste voluptate quas dicta corporis,
                                                incidunt quibusdam quia odit unde, rem harum quis! Optio debitis veniam quibusdam, culpa quia, aperiam cupiditate perspiciatis repellat similique saepe magnam quaerat iusto obcaecati doloremque, dolor praesentium.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion13" class="collapsed" aria-expanded="false"> <span class="open-sub"></span> <strong>Q. Am I allowed to modify the item that I purchased?</strong></a>                                        </div>
                                    <div id="accordion13" class="panel-collapse collapse" role="tablist" aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dolor rerum enim doloremque iusto eos atque tempora dignissimos similique, quae, maxime sit accusantium delectus, maiores officiis vitae
                                                fuga sunt repellendus. Molestiae quae, ducimus ut tenetur nobis id quam autem quibusdam commodi inventore laborum libero officiis</p>
                                            <p>Accusantium a laboriosam cumque consequatur voluptates fuga assumenda corporis amet. Vitae placeat architecto ipsa cumque fugiat, atque molestiae perferendis quasi quaerat iste voluptate quas dicta corporis,
                                                incidunt quibusdam quia odit unde, rem harum quis! Optio debitis veniam quibusdam, culpa quia, aperiam cupiditate perspiciatis repellat similique saepe magnam quaerat iusto obcaecati doloremque, dolor praesentium.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion14" class="collapsed" aria-expanded="false"> <span class="open-sub"></span> <strong>Q. What does non-exclusive mean?</strong></a> </div>
                                    <div id="accordion14" class="panel-collapse collapse" role="tablist" aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dolor rerum enim doloremque iusto eos atque tempora dignissimos similique, quae, maxime sit accusantium delectus, maiores officiis vitae
                                                fuga sunt repellendus. Molestiae quae, ducimus ut tenetur nobis id quam autem quibusdam commodi inventore laborum libero officiis</p>
                                            <p>Accusantium a laboriosam cumque consequatur voluptates fuga assumenda corporis amet. Vitae placeat architecto ipsa cumque fugiat, atque molestiae perferendis quasi quaerat iste voluptate quas dicta corporis,
                                                incidunt quibusdam quia odit unde, rem harum quis! Optio debitis veniam quibusdam, culpa quia, aperiam cupiditate perspiciatis repellat similique saepe magnam quaerat iusto obcaecati doloremque, dolor praesentium.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion15" class="collapsed" aria-expanded="false"> <span class="open-sub"></span> <strong>Q. What is a single application?</strong></a> </div>
                                    <div id="accordion15" class="panel-collapse collapse" role="tablist" aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dolor rerum enim doloremque iusto eos atque tempora dignissimos similique, quae, maxime sit accusantium delectus, maiores officiis vitae
                                                fuga sunt repellendus. Molestiae quae, ducimus ut tenetur nobis id quam autem quibusdam commodi inventore laborum libero officiis</p>
                                            <p>Accusantium a laboriosam cumque consequatur voluptates fuga assumenda corporis amet. Vitae placeat architecto ipsa cumque fugiat, atque molestiae perferendis quasi quaerat iste voluptate quas dicta corporis,
                                                incidunt quibusdam quia odit unde, rem harum quis! Optio debitis veniam quibusdam, culpa quia, aperiam cupiditate perspiciatis repellat similique saepe magnam quaerat iusto obcaecati doloremque, dolor praesentium.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- divider: what makes us different -->
            <section class="divider parallax layer-overlay overlay-white-9" data-parallax-ratio="0.1" data-bg-img="{{ asset('assets/website/images/bg/bg2.jpg') }}">
                <div class="container">
                    <div class="section-content text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mt-0">Did not find your answer?</h3>
                                <h2>Just call at <span class="text-theme-color-2">(+92) 340 3936000</span> for emergency service</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
