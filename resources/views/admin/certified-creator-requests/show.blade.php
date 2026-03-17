@extends('layouts.app.master')

@section('title', 'Review Certified Creator Request')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Review Request #{{ $creatorRequest->id }}</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.certified-creator-requests.index') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-3">
            <div class="card-header">
                <h5>Artist Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $creatorRequest->artist->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $creatorRequest->artist->email ?? 'N/A' }}</p>
                <p><strong>Username:</strong> {{ $creatorRequest->artist->username ?? 'N/A' }}</p>
                <p><strong>Status:</strong>
                    @if($creatorRequest->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($creatorRequest->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5>Submitted Reason</h5>
            </div>
            <div class="card-body">
                <p>{{ $creatorRequest->reason }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5>Documents</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>KYC Document:</strong>
                    <a href="{{ asset('storage/' . $creatorRequest->kyc_document_path) }}" target="_blank">View KYC File</a>
                </p>
                <p>
                    <strong>Supporting Document:</strong>
                    @if($creatorRequest->supporting_document_path)
                        <a href="{{ asset('storage/' . $creatorRequest->supporting_document_path) }}" target="_blank">View Supporting File</a>
                    @else
                        Not provided
                    @endif
                </p>
            </div>
        </div>

        @if($creatorRequest->status === 'pending')
            <div class="card">
                <div class="card-header">
                    <h5>Review Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.certified-creator-requests.approve', $creatorRequest->id) }}">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Admin Notes (optional)</label>
                                    <textarea class="form-control" name="admin_notes" rows="4" placeholder="Optional approval notes"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Approve Request</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.certified-creator-requests.reject', $creatorRequest->id) }}">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="admin_notes" rows="4" placeholder="Why is this rejected?" required></textarea>
                                    @error('admin_notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger">Reject Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h5>Review Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>Reviewed By:</strong> {{ $creatorRequest->reviewer->name ?? 'N/A' }}</p>
                    <p><strong>Reviewed At:</strong> {{ $creatorRequest->reviewed_at?->format('d M Y, h:i A') ?? 'N/A' }}</p>
                    <p><strong>Admin Notes:</strong> {{ $creatorRequest->admin_notes ?? 'No notes provided.' }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
