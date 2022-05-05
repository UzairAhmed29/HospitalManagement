@include('partials/navigation')
<style>
    section.doctor-section {
        background-image: url( '{{asset('/images/doctors.png')}}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        padding: 20% 0px;
    }
    section.doctor-content {
        padding: 50px 0;
        width: 80%;
        margin: 0 auto;
    }

    .product {
        margin-bottom: 30px;
    }
    .product-inner {
        box-shadow: 0 0 10px rgba(0,0,0,.2);
        padding: 10px;
    }
    .product img {
        margin-bottom: 10px;
    }
</style>
<section class="doctor-section"></section>
<section class="doctor-content">
    <h1>Doctors</h1>
    <div class="container">
        <div class="" id="search">
            <form id="search-form" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group col-xs-9">
                    <input class="form-control" type="text" placeholder="Search" />
                </div>
                <div class="form-group col-xs-3">
                    <button type="submit" class="btn btn-block btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="" id="filter">
            <form>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="make" class="filter-make filter form-control">
                        <option value="">Select Make</option>
                        <option value="">Show All</option>
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="model" class="filter-model filter form-control">
                        <option value="">Select Model</option>
                        <option value="">Show All</option>
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="type" class="filter-type filter form-control">
                        <option value="">Select Type</option>
                        <option value="">Show All</option>
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="price" class="filter-price filter form-control">
                        <option value="">Select Price Range</option>
                        <option value="">Show All</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="" id="doctors">

        </div>
    </div>
</section>

@include('partials/footer')
