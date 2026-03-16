@extends('layouts.app.master')

@section('title', 'Subscription Plans List')

@section('css')
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Subscription Plans List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Subscription Plans</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
         
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="{{ route('admin.subplan.add') }}">
                                <i class="fa fa-plus pe-2"></i>Add Plan
                            </a>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0">
                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                            <th>Duration</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subplans as $subplan)
                                            <tr class="product-removes">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><p class="c-o-light">{{ $subplan->title }}</p></td>
                                                <td><p class="c-o-light">${{ number_format($subplan->amount, 2) }}</p></td>
                                                <td><p class="c-o-light">{{ $subplan->duration }} Month</p></td>
                                                <td>
                                                    <div class="product-action d-flex gap-2">
                                                        <a class="square-white" href="{{ route('admin.subplan.edit', $subplan->id) }}">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
                                                            </svg>
                                                        </a>

                                                        <form action="{{ route('admin.subplan.destroy', $subplan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plan?');" style="display:inline;">
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
                                                <td colspan="5" class="text-center">No subscription plans found.</td>
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
