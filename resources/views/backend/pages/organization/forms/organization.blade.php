<div class="card-body">
    {{-- Name --}}
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" required name="name" value="{{ $organization->name ?? '' }}" placeholder="Organization Name"
                class="form-control" id="name">
        </div>
    </div>

    {{-- Bangla Name --}}
    <div class="form-group row">
        <label for="bn_name" class="col-sm-2 col-form-label">Name (Bangla)</label>
        <div class="col-sm-9">
            <input type="text" name="bn_name" value="{{ $organization->bn_name ?? '' }}"
                placeholder="Organization Name Bangla" class="form-control" id="bn_name">
        </div>
    </div>

    {{-- Category --}}
    <div class="form-group row">
        <label for="organization_category_id" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="organization_category_id" id="organization_category_id">
                <option value=""> Category</option>
                @if (count($categories))
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($organization->organization_category_id) ? ($organization->organization_category_id == $category->id ? 'selected' : '') : '' }}>
                            {{ $category->en_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div> 

    {{-- Subcategory --}}
    <div class="form-group row">
        <label for="organization_subcategory_id" class="col-sm-2 col-form-label">Sub Category</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="organization_subcategory_id"
                id="organization_subcategory_id">
                @if (isset($organization->organization_subcategory_id))
                    <option value="{{ $organization->organization_subcategory_id }}">
                        {{ $organization->subcategory->en_name }}</option>
                @endif
            </select>
        </div>
    </div>

    {{-- Work Area --}}
    <div class="form-group row">
        <label for="organization_work_area_id" class="col-sm-2 col-form-label"  style="width: 100%;">Work Area</label>
        <div class="col-sm-9">
            <select  class="form-control select2" multiple="multiple" name="organization_work_area_id[]" id="organization_work_area_id">
                @if (isset($organization->organization_work_area_id))
                    @php
                        $work_areas = json_decode($organization->organization_work_area_id, true);
                    @endphp
                    @foreach($areas as $area)
                        <option value="{{$area->id}}" {{in_array( $area->id , $work_areas) ? 'selected' : '' }} >{{$area->en_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- Organization Type --}}
    <div class="form-group row">
        <label for="organization_type_id" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="organization_type_id" id="organization_type_id">
                @if (isset($organization->type))
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{$organization->type->id == $type->id ? 'selected' : '' }}>{{$type->en_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- RJSC Reg. --}}
    <div class="form-group row">
        <label for="rjsc_reg_no" class="col-sm-2 col-form-label">RJSC Reg.</label>
        <div class="col-sm-9">
            <input type="text" name="rjsc_reg_no" value="{{ $organization->rjsc_reg_no ?? '' }}"
                placeholder="RJSC Reg. No." class="form-control" id="rjsc_reg_no">
        </div>
    </div>

    {{-- Ownership Type --}}
    <div class="form-group row">
        <label for="organization_ownership_type_id" class="col-sm-2 col-form-label">Ownership Type</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="organization_ownership_type_id"
                id="organization_ownership_type_id">
                <option value="">Ownership Type</option>
                @if (count($ownership_types))
                    @foreach ($ownership_types as $type)
                        <option value="{{ $type->id }}"
                            {{ isset($organization->organization_ownership_type_id) ? ($organization->organization_ownership_type_id == $type->id ? 'selected' : '') : '' }}>
                            {{ $type->en_name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- Number of Owner --}}
    <div class="form-group row number_of_owner {{ isset($organization->organization_ownership_type_id) ? ($organization->organization_ownership_type_id == 1 ? 'd-none' : '') : '' }}">
        <label for="no_of_owner" class="col-sm-2 col-form-label">No. of Owner</label>
        <div class="col-sm-9">
            <input type="number" name="no_of_owner" value="{{ $organization->no_of_owner ?? '' }}" placeholder="Number of Owner"
                class="form-control" id="no_of_owner">
        </div>
    </div>

     {{-- Village --}}
     <div class="form-group row">
        <label for="village_id" class="col-sm-2 col-form-label">Village</label>
        <div class="col-sm-9">
            <select class="form-control" id="village_id" name="village_id">
                <option value="">Select Village</option>
                @if (count($villages))
                    @foreach ($villages as $village)
                        <option value="{{$village->id}}">{{$village->en_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

     {{-- Ward No. --}}
     <div class="form-group row">
        <label for="ward_no_id" class="col-sm-2 col-form-label">Ward No.</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="union_ward_id" id="ward_no_id">
                <option value="">Ward No.</option>
                @if (count($wards))
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->id }}"
                            {{ isset($organization->union_ward_id) ? ($organization->union_ward_id == $ward->id ? 'selected' : '') : '' }}>
                            {{ $ward->en_ward_no }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- Area --}}
    <div class="form-group row">
        <label for="village_area_id" class="col-sm-2 col-form-label">Area</label>
        <div class="col-sm-9">
            <select class="form-control" id="village_area_id" name="village_area_id">
                <option value="">Select Village Area</option>
            </select>
        </div>
    </div>

     {{-- Road --}}
     <div class="form-group row">
        <label for="road_id" class="col-sm-2 col-form-label">Road</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="road_id" id="road_id">
                <option value="">Select Road</option>
                @if (count($roads))
                    @foreach ($roads as $road)
                        <option value="{{ $road->id }}"
                            {{ isset($organization->road_id) ? ($organization->road_id == $road->id ? 'selected' : '') : '' }}>
                            {{ $road->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- House --}}
    <div class="form-group row">
        <label for="house_id" class="col-sm-2 col-form-label">House</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="house_id" id="house_id">
                @if (isset($organization->house_id))
                    <option value="{{ $organization->house_id }}">{{ $organization->house->en_name }}</option>
                @endif
            </select>
        </div>
    </div>

    {{-- Capital --}}
    <div class="form-group row">
        <label for="capital" class="col-sm-2 col-form-label">Capital</label>
        <div class="col-sm-9">
            <input type="number" name="capital" value="{{ $organization->capital ?? '' }}" placeholder="Capital"
                class="form-control" id="capital">
        </div>
    </div>

    {{-- Established Year --}}
    <div class="form-group row">
        <label for="establish_year" class="col-sm-2 col-form-label">Est. Year</label>
        <div class="col-sm-9">
            <input type="number" min="1900" max="{{ date('Y') }}" value={{ date('Y') }}
                step="1" name="establish_year" value="{{ $organization->establish_year ?? '' }}"
                placeholder="Established Year " class="form-control" id="establish_year">
        </div>
    </div>

    {{-- Application Type --}}
    <div class="form-group row">
        <label for="application_type" class="col-sm-2 col-form-label">Application Type</label>
        <div class="col-sm-9">
            <select  class="form-control select2" name="application_type" id="application_type">
                <option value="new"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'new' ? 'selected' : '') : '' }}>
                    NEW</option>
                <option value="old"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'old' ? 'selected' : '') : '' }}>
                    OLD</option>
            </select>
        </div>
    </div>

  
</div>

@push('script')

<script>
    $(document).on('change', '#organization_ownership_type_id', function(e){
        e.preventDefault();
        if($(this).val() == 2 ){
            $('.number_of_owner').removeClass('d-none');
        }else {
            $('.number_of_owner').removeClass('d-none').addClass('d-none');
        }
    })

    $(document).on('change', '#organization_category_id', function(e){
      e.preventDefault();
      let _this_value = $(this).val();
      if(_this_value){
          $.ajax({
              type: "GET",
              url: "{{ url('organization-subcategory-options') }}/"+_this_value,
              beforeSend: function() {
                  $('#organization_subcategory_id').prop("disabled", true);
                  console.log("Searcing organization category");
              },
              success: function(response) {
                  $('#organization_subcategory_id').html(response)
                  $('#organization_subcategory_id').prop("disabled", false);
              },
              error: function(xhr, status, error) {
                  var responseText = jQuery.parseJSON(xhr.responseText);
                  toastr.error(responseText.message);
              }

          });
          $.ajax({
            type: "GET",
            url: "{{ url('organization-type-options') }}/"+_this_value,
            beforeSend: function() {
                $('#organization_type_id').prop("disabled", true);
                console.log("Searcing organization type");
            },
            success: function(response) {
                $('#organization_type_id').html(response)
                $('#organization_type_id').prop("disabled", false);
            },
            error: function(xhr, status, error) {
                $('#organization_type_id').prop("disabled", false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
            }
          });
      }
    })
    
    $(document).on('change', '#organization_subcategory_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('organization-work-area-options') }}/"+_this_value,
                beforeSend: function() {
                    $('#organization_work_area_id').prop("disabled", true);
                    console.log("Searcing Work Area");
                },
                success: function(response) {
                    $('#organization_work_area_id').html(response)
                    $('#organization_work_area_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }
    })

    $(document).on('change', '#village_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('get-areas-by-village') }}/"+_this_value,
                beforeSend: function() {
                    $('#village_area_id').prop("disabled", true);
                    console.log("Searcing Village Area");
                },
                success: function(response) {
                    $('#village_area_id').html(response)
                    $('#village_area_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }
    })

    $(document).on('change', '#village_area_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('get-houses-by-village-area') }}/"+_this_value,
                beforeSend: function() {
                    $('#house_id').prop("disabled", true);
                    console.log("Searcing Houses");
                },
                success: function(response) {
                    $('#house_id').html(response)
                    $('#house_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        }
    })
</script>
    
@endpush
