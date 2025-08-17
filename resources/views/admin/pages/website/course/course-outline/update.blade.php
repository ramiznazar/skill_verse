@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Update Course Outline</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-outline.index', $course->id) }}" class="btn btn-sm btn-primary">All Outlines</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Course Outline – {{ $outline->week }}</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form"
                                  action="{{ route('course-outline.update', ['course' => $course->id, 'id' => $outline->id]) }}"
                                  method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                {{-- Week --}}
                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input type="text" name="week" class="form-control"
                                           value="{{ old('week', $outline->week) }}" required>
                                    @error('week')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Topics --}}
                                <div id="topics-wrapper">
                                    @php $topics = old('topics', $outline->topics ?? []); @endphp
                                    @foreach ($topics as $index => $topic)
                                        <div class="form-group topic-block">
                                            <label>Topic</label>
                                            <input type="text" name="topics[{{ $index }}][topic]" class="form-control"
                                                   value="{{ $topic['topic'] }}" required>

                                            <label class="mt-2">Time</label>
                                            <input type="text" name="topics[{{ $index }}][time]" class="form-control"
                                                   value="{{ $topic['time'] }}">
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addTopic()">+ Add Another Topic</button>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Course Outline</button>
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
    let topicIndex = {{ count($topics) }};

    function addTopic() {
        const wrapper = document.getElementById('topics-wrapper');
        const html = `
            <div class="form-group topic-block">
                <label>Topic</label>
                <input type="text" name="topics[${topicIndex}][topic]" class="form-control" required>
                <label class="mt-2">Time</label>
                <input type="text" name="topics[${topicIndex}][time]" class="form-control" required>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        topicIndex++;
    }
</script>
@endsection
