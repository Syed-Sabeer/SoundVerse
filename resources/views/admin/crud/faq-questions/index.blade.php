@extends('layouts.app.master')

@section('title', 'Chatbot QnA')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Chatbot QnA List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Chatbot QnA</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="{{ route('admin.faq-question.create') }}">
                                <i class="fa fa-plus pe-2"></i>Add Chatbot QnA
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th><span class="c-o-light f-w-600">Question</span></th>
                                            <th><span class="c-o-light f-w-600">Answer</span></th>
                                            <th><span class="c-o-light f-w-600">Keywords</span></th>
                                            <th><span class="c-o-light f-w-600">Status</span></th>
                                            <th><span class="c-o-light f-w-600">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($faqQuestions as $faqQuestion)
                                            <tr class="product-removes">
                                                <td></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <p class="c-o-light">{{ \Illuminate\Support\Str::limit($faqQuestion->question, 50, '...') }}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light">{{ \Illuminate\Support\Str::limit(strip_tags($faqQuestion->answer), 50, '...') }}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light">{{ \Illuminate\Support\Str::limit($faqQuestion->keywords, 30, '...') }}</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <form method="POST" action="{{ route('admin.faq-question.toggleStatus', $faqQuestion->id) }}" style="display:inline;" class="toggle-status-form">
                                                            @csrf
                                                            <div class="form-check form-switch form-check-inline">
                                                                <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" {{ $faqQuestion->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product-action">
                                                        <a class="square-white" href="{{ route('admin.faq-question.edit', $faqQuestion->id) }}">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('admin.faq-question.destroy', $faqQuestion->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Chatbot QnA?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
                                                                <svg>
                                                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <p class="c-o-light">No Chatbot QnA found. <a href="{{ route('admin.faq-question.create') }}">Add one now</a></p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
