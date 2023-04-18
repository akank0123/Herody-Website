@extends('admin.master')

@section('title', 'Admin | Create Telecalling Project')
@section('heads')
<style>
    .cats{
        background: #ffff;
        color: black;
        box-shadow: 0 0 2px 2px gray;
        border-radius: 5px;
    }
</style>
@endsection

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h4 class="text-center">Create a Telecalling Project</h4>
            <form action="{{route('admin.telecalling.create')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group mb-3">
                    <label for="title">Enter project title</label>
                    <input type="text" class="form-control form-control-lg" name="title" placeholder="Enter project title" >
                </div>
                <div class="form-group mb-3">
                    <label for="company">Enter company</label>
                    <input type="text" class="form-control form-control-lg" name="company" placeholder="Enter project company" >
                </div>
                <div class="form-group mb-3">
                    <input type="file" id="logo" name="logo" hidden>
                    <button onclick="document.getElementById('logo').click();" type="button" class="btn btn-success btn-lg">Upload project logo</button>
                </div>
                <div class="form-group mb-3">
                    <span for="category">Enter project category</span>
                    <input type="text" class="form-control form-control-lg" name="category" placeholder="Enter project category" >
                </div>
                
                <div class="form-group mb-3">
                    <span for="last_date">Enter project last date</span>
                    <input type="date" class="form-control form-control-lg" name="last_date" placeholder="Enter project last date" >
                </div>

                <h3 class="mt-3">Call Script</h3>
                <div class="form-group mb-3">
                    <label for="script_des">Call script description</label>
                    <textarea name="script_des"></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="file" id="script_img" name="script_img" hidden>
                    <button onclick="document.getElementById('script_img').click();" type="button" class="btn btn-success btn-lg">Upload call script image(optional)</button>
                </div>

                <h3 class="mt-3">Demo Audio</h3>
                <div class="form-group mb-3">
                    <label for="audio_des">Demo audio description</label>
                    <textarea name="audio_des"></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="file" id="audio_file" name="audio_file" hidden>
                    <button onclick="document.getElementById('audio_file').click();" type="button" class="btn btn-success btn-lg">Upload demo audio file(optional)</button>
                </div>

                <h3 class="mt-3">Call Objective</h3>
                <div class="form-group mb-3">
                    <label for="obj_des">Call objective description</label>
                    <textarea name="obj_des"></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="file" id="obj_img" name="obj_img" hidden>
                    <button onclick="document.getElementById('obj_img').click();" type="button" class="btn btn-success btn-lg">Upload call objective image(optional)</button>
                </div>

                <h3 class="mt-3">Call Outcomes</h3>
                <div id="outcomes">
                    <div>
                        <div class="form-group mb-3">
                            <label for="outcome_title">Call outcome title</label>
                            <input type="text" name="outcome_title[]" placeholder="Enter outcome title" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group mb-3">
                            <label for="outcome_des">Call outcome description</label>
                            <input type="text" name="outcome_des[]" placeholder="Enter outcome description" required class="form-control form-control-lg">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addOutcome();" class="btn btn-secondary mb-3">Add outcome</button>
                <div class="form-group mb-3">
                    <label for="amount">Enter amount per call</label>
                    <input type="number" name="amount" class="form-control form-control-lg">
                </div>

                <div class="form-group mb-3">
                    <input type="file" id="file" name="file" hidden>
                    <button onclick="document.getElementById('file').click();" type="button" class="btn btn-success btn-lg">Upload excel file with data</button>
                </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')

{{--dropdown active--}}
<script>
    $('#telecalling li:nth-child(2)').addClass('active');
    $('#telecalling').addClass('show');
</script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('script_des');
    CKEDITOR.replace('audio_des');
    CKEDITOR.replace('obj_des');
</script>
<script>
    function addOutcome(){
        $("#outcomes").append(`
            <div>
                <div class="form-group mb-3">
                    <label for="outcome_title">Call outcome title</label>
                    <input type="text" name="outcome_title[]" placeholder="Enter outcome title" required class="form-control form-control-lg">
                </div>
                <div class="form-group mb-3">
                    <label for="outcome_des">Call outcome description</label>
                    <input type="text" name="outcome_des[]" placeholder="Enter outcome description" required class="form-control form-control-lg">
                </div>
                <button class="btn btn-danger mb-4" type="button" onclick="deleteOutcome(this)">Delete this</button>
            </div>
        `)
    }
    function deleteOutcome(obj){
        $($(obj).parent()).remove();
    }
</script>
@endsection