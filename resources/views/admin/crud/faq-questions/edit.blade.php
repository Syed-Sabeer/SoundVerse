@extends('layouts.app.master')

@section('title', 'Edit Chatbot QnA')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Edit Chatbot QnA</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.faq-question.index') }}">Chatbot QnA</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Chatbot QnA Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-xl-5 g-3">
                            <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                                <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="detail-product-tab" data-bs-toggle="pill" href="#detail-product" role="tab" aria-controls="detail-product" aria-selected="false">
                                            <div class="nav-rounded">
                                                <div class="product-icons">
                                                    <svg class="stroke-icon">
                                                        <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#product-detail') }}"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="product-tab-content">
                                                <h6>Edit QnA Details</h6>
                                                <p>Update question, answer & keywords</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                                <div class="tab-content custom-input" id="add-product-pills-tabContent">
                                    <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                                        <div class="sidebar-body">
                                            <form class="row g-3 common-form" method="POST" action="{{ route('admin.faq-question.update', $faqQuestion->id) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="col-md-12">
                                                    <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="question" id="question" rows="3" placeholder="Enter the question" required>{{ old('question', $faqQuestion->question) }}</textarea>
                                                    <small class="form-text text-muted">Enter the question that users might ask.</small>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label" for="answer">Answer <span class="text-danger">*</span></label>
                                                    <textarea id="answer" name="answer" class="form-control" rows="6" placeholder="Enter the answer" required>{{ old('answer', $faqQuestion->answer) }}</textarea>
                                                    <small class="form-text text-muted">Enter the answer to the question.</small>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label" for="keywords">Keywords <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="keywords" id="keywords" type="text" placeholder="e.g., subscription, payment, account, billing" value="{{ old('keywords', $faqQuestion->keywords) }}" required>
                                                    <small class="form-text text-muted">Enter comma-separated keywords that match this QnA (e.g., subscription, payment, account).</small>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $faqQuestion->is_active) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_active">
                                                            Active
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Only active QnAs will be used by the chatbot.</small>
                                                </div>

                                                <div class="col-md-12">
                                                    <button class="btn btn-primary f-w-500" type="submit">Update</button>
                                                    <a href="{{ route('admin.faq-question.index') }}" class="btn btn-secondary f-w-500 ms-2">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('answer', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                { name: 'styles', items: ['Format', 'FontSize'] },
                { name: 'links', items: ['Link', 'Unlink'] }
            ],
            removePlugins: 'elementspath',
            resize_enabled: false
        });
    });
</script>
@endsection
