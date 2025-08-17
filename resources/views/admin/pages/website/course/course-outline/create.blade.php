@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Outlines</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-outline.index', $course->id) }}" class="btn btn-sm btn-primary"
                        title="">All Outlines</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('course-outline.store', $course->id) }}" method="POST"
                                novalidate>
                                @csrf

                                {{-- Week Input --}}
                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input type="text" name="week" class="form-control" placeholder="e.g., Week 1"
                                        value="{{ old('week') }}">
                                    @error('week')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Topics Section --}}
                                <div id="topics-wrapper">
                                    <div class="form-group topic-block">
                                        <label>Topic</label>
                                        <input type="text" name="topics[0][topic]" class="form-control"
                                            placeholder="Enter topic" required>

                                        <label class="mt-2">Time</label>
                                        <input type="text" name="topics[0][time]" class="form-control"
                                            placeholder="e.g., 45 mins" >
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addTopic()">+ Add
                                    Another Topic</button>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Course Outline</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional-javascript')
    <script>
        $(function() {
            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
        });
    </script>
@endsection
{{-- JavaScript for Adding Topics --}}
<script>
    let topicIndex = 1;

    function addTopic() {
        const wrapper = document.getElementById('topics-wrapper');
        const newTopicHTML = `
            <div class="form-group topic-block">
                <label>Topic</label>
                <input type="text" name="topics[${topicIndex}][topic]" class="form-control" placeholder="Enter topic" required>

                <label class="mt-2">Time</label>
                <input type="text" name="topics[${topicIndex}][time]" class="form-control" placeholder="e.g., 45 mins" required>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', newTopicHTML);
        topicIndex++;
    }
</script>
