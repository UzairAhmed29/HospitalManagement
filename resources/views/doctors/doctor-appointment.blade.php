
@section('styles')
<link rel="stylesheet" href="{{ asset('/css/appointment-calendar.css') }}">
@endsection

@include('partials/navigation')

<section class="hospital-section"></section>
<section class="hospital-content">

    <div class="card-wrapper">
        <div class="main-detail">
          <div class="product-imgs">
            <div class="img-select">
                @php
                    if( isset($doctor->picture) ):
                        $picture = asset("/public/uploads/doctor/".$doctor->picture);
                    else :
                        $picture = asset("/images/non-doctor-app.png");
                    endif;
                @endphp
                <img src="{{ $picture }}">
            </div>
          </div>
          <div class="product-content">
            <h2 class="product-title">{{ $doctor->name }}</h2>
            <div class="product-price">
              <p class="margin-non new-price"> Consultation Fee: <span>Rs. {{ number_format($doctor->fee, 0) }}</span></p>
            </div>
            <div class="product-detail">
              <ul>
                @if(isset($doctor->hospital) && $doctor->hospital != null)
                <li>Hospital: <span>{{ $doctor->hospital->name }}</span></li>
                <li>Hospital Phone: <span>{{ $doctor->hospital->phone }}</span></li>
                @endif
                <li>Education: <span>{{ $doctor->education }}</span></li>
                <li>Expirience: <span>{{ $doctor->expirience }}</span></li>
                <li>Working Days: <span>{{ $doctor->working_days }}</span></li>
                <li>Doctor Timmings: <span>{{ $doctor->timming }}</span></li>
                @php
                    $s = $doctor->specialist;
                    $spec = explode(",", $s);
                    echo "<li style='width: 110%;'>Specialist In: ";
                    foreach( $spec as $i ) {
                        $j = \App\Models\Services::find($i);
                        if( !empty($j) && $j != null ) {
                            echo '<span class="specialist">'. $j->name .'</span>';
                        }
                    }
                    echo "</li>";
            @endphp

              </ul>
            </div>
            <div class="purchase-info">
              <button type="button" class="btn">
                <a href="#calendar"><i class="fa fa-calendar" aria-hidden="true"></i> Book Now </a>
            </button>
            </div>
          </div>
        </div>
    </div>
    @if(Session::has('success'))
        <div id="remove-noti" class="alert alert-success" role="alert" style="margin: 20px 0;">
            @if(Session::get('success') == 'true')
            <span>
                Thank you for Booking the Appointment,
                Your booked slot is on hold and it will be confirmed by the doctor.
                You can check the status of your appointment from your dashboard.
            </span>
            @endif
        </div>
    @endif
    <div class="calendar" id="calendar">
        <div class="cal-header">
            <div class="actions">
                <i id="leftArrow" class="fa fa-chevron-left" aria-hidden="true"></i>
                <i id="rightArrow" class="fa fa-chevron-right" aria-hidden="true"></i>
            </div>
            <div class="datepicker-main">
                <input type="date"  name="cal-datepicker" class="cal-datepicker" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime("+30 days")) }}">
            </div>
        </div>
        <div class="cal-blocks" id="blocks-main">
            {{ day_loop( $doctor, $range, $fill_slots ) }}
        </div>
    </div>
    <div data-ml-modal id="modal-popup" class="booking--model">
        <a href="#modal-popup" class="modal-overlay"></a>
        <div class="modal-dialog">
        <div class="modal-header">
            <p class="header-slot_name">Appointment Form</p>
                <a href="#_"><i class="fa fa-close"></i></a>
        </div>
            <div class="modal-content center">
                <div class='slot_submission'>
                    <p class='doctor-name'><strong>Doctor: </strong> <span>{{ $doctor->name }}</span></p>
                    <p class='hospital'><strong>Hospital: </strong><span>{{ $doctor->hospital->name }}</span></p>
                    <div class='slot_info'>
                        <p class='slot_title'><strong>Slot: </strong><span> 10 May 2022 08:00 am</span></p>
                        <p class='slot_fee'><strong>Consultation Fee: </strong><span>Rs. {{ number_format($doctor->fee, 0) }}</span></p>
                    </div>
                    <form name="appointmen-form" method="POST" action="{{ route('doctor_app') }}">
                        @csrf
                        <div class="app-form">
                            <div class="form--group">
                                <p><strong>Name <span class="text-danger">*</span></strong></p>
                                <input type="text" name="name" placeholder="Name" class="" required>
                            </div>
                            <div class="form--group">
                                <p><strong>Email <span class="text-danger">*</span></strong></p>
                                <input type="email" name="email" placeholder="Email" class="" required>
                            </div>

                            @if(Auth::guest())
                                <div class="form--group">
                                    <p><strong>Password <span class="text-danger">*</span></strong></p>
                                    <input type="password" name="password" placeholder="Password" class="" required>
                                </div>
                            @endif

                            <div class="form--group">
                                <p><strong>Phone <span class="text-danger">*</span></strong></p>
                                <input type="text" name="phone" placeholder="Phone" class="">
                            </div>
                            <input type="hidden" name="doctor_name" value="{{ $doctor->name }}">
                            <input type="hidden" name="doctor_slug" value="{{ $doctor->slug }}">
                            <input type="hidden" name="hospital_name" value="{{ $doctor->hospital->name }}">
                            <input type="hidden" name="fee" value="Rs. {{ number_format($doctor->fee, 0) }}">
                            <input type="hidden" name="slot" value="">
                            <input type="hidden" name="auth" value="{{ Auth::guest() }}">
                            <input type="hidden" name="date" value="">
                            <input type="hidden" name="day" value="">
                            <button type='submit' id='slot_submit'>Confirm Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
/* checkout page css  */

</style>
@section('scripts')
<script src="{{ asset('/js/appointment-calendar.js') }}"></script>
@endsection
@include('partials/footer')

<?php
    function day_loop( $doctor, $range, $fill_slots ) {

        $startTime = strtotime( 'now' );
        $endTime = strtotime( 'now' ) + (2592000 * 1);

        for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
            $id = null;

            $d = date("D", $i);
            $working_days = explode(',', $doctor->working_days);
            if( date('d', $i) == date('d') ) {
                $id = "id='current'";
            }

            if( (is_array($working_days) || count($working_days) > 0 || !empty($working_days)) && in_array($d, $working_days) ) {
                d_slot( $id, $i, $range, $fill_slots );
            } else {
                e_slot( $id, $i, $range );
            }


        }
    }

    function d_slot( $id, $i, $time, $fill_slots ) { ?>
        <div class="slot_items" <?php echo $id; ?>>
            <div class="block" id="{{ date('Y-m-d', $i) }}">
                <p class="day">{{ date('D', $i) }}</p>
                <p class="active-p">{{ date('d', $i) }}</p>
            </div>
            <div class="content-block">
                <input type="hidden" name="day_name" value="{{ date("l", $i) }}">
                    <?php
                        foreach( $time as $key => $slot ) :
                            if( is_array($fill_slots) && in_array(date("d-M-Y ", $i) . $slot, array_keys($fill_slots)) ) : ?>
                                <a href="#_" class="slot-init" id="booked">
                                    <p class="slot" data-slot="{{ $slot }}" data-time="{{ date("d-M-Y ", $i).$slot }}">
                                        <span><i class="fa fa-clock-o"></i>
                                        <?php echo $slot; ?></span>
                                    </p>
                                </a>
                        <?php else: ?>
                            <a href="#_" class="slot-init">
                                <p class="slot" data-slot="{{ $slot }}" data-time="{{ date("d-M-Y ", $i).$slot }}">
                                    <span><i class="fa fa-clock-o"></i>
                                    <?php echo $slot; ?></span>
                                </p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </div>
        </div>

        <?php
    }

    function e_slot( $id, $i, $time ) { ?>

        <div data-toggle="tooltip" data-placement="top" title="Day Off" class="slot_items disabled" <?php echo $id; ?>>
            <div class="block" id="{{ date('Y-m-d', $i) }}">
                <p class="day">{{ date('D', $i) }}</p>
                <p class="active-p">{{ date('d', $i) }}</p>
            </div>
            <div class="content-block">
                <p class="slot-time">
                    <?php
                        foreach( $time as $key => $slot ) : ?>
                            <p class="slot" data-time="{{ date("d-M-Y ", $i).$slot }}"><span><i class="fa fa-clock-o"></i></span><?php echo $slot; ?></p>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>

        <?php
    }

?>
