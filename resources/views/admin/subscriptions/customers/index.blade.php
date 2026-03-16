@extends('layouts.app.master')

@section('title', 'Subscription Plans')

@section('css')
@endsection

@section('content')

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Subscription Plans</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Subscriptions</li>
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
                    <div class="card-header-right-icon"><a class="btn btn-primary f-w-500" href="{{route('admin.subscription.add')}}"><i class="fa fa-plus pe-2"></i>Add Subscription Plan</a></div>
                  </div>
                  <div class="card-body px-0 pt-0">
                    <div class="list-product">
                      <div class="recent-table table-responsive custom-scrollbar product-list-table">
                        <table class="table" >
                          <thead>
                            <tr>
                              <th></th>
                              <th>No.</th>
                              <th> <span class="c-o-light f-w-600">Title</span></th>
                              <th> <span class="c-o-light f-w-600">Price</span></th>
                              <th> <span class="c-o-light f-w-600">Duration</span></th>
                              <th> <span class="c-o-light f-w-600">Duration (Months)</span></th>
                              <th> <span class="c-o-light f-w-600">Unlimited Streaming</span></th>
                              <th> <span class="c-o-light f-w-600">No Ads</span></th>
                              <th> <span class="c-o-light f-w-600">Offline</span></th>
                              <th> <span class="c-o-light f-w-600">High Quality</span></th>
                              <th> <span class="c-o-light f-w-600">Unlimited Playlist</span></th>
                              <th> <span class="c-o-light f-w-600">Playlist Limit</span></th>
                              <th> <span class="c-o-light f-w-600">Offline Limit</span></th>
                              <th> <span class="c-o-light f-w-600">Exclusive Content</span></th>
                              <th> <span class="c-o-light f-w-600">Tip Artists</span></th>
                              <th> <span class="c-o-light f-w-600">Supporter Badge</span></th>
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                          <tbody>

                            @foreach ($subscriptions as $subscription)

                            <tr class="product-removes">
                                <td></td>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                <p class="c-o-light">{{$subscription->title}}</p>
                              </td>
                              <td>
                                <p class="c-o-light">${{$subscription->price}}</p>
                              </td>
                              <td>
                                <p class="c-o-light">{{$subscription->duration}}</p>
                              </td>
                              <td>
                                <p class="c-o-light">{{$subscription->duration_months}} months</p>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_unlimitedstreaming ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_unlimitedstreaming ? 'Yes' : 'No' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_ads ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_ads ? 'No Ads' : 'With Ads' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_offline ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_offline ? 'Yes' : 'No' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_highquality ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_highquality ? 'Yes' : 'No' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_unlimitedplaylist ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_unlimitedplaylist ? 'Unlimited' : 'Limited' }}
                                </span>
                              </td>
                              <td>
                                <p class="c-o-light">{{ $subscription->playlist_limit ?? ($subscription->is_unlimitedplaylist ? 'Unlimited' : 'N/A') }}</p>
                              </td>
                              <td>
                                <p class="c-o-light">
                                  @if($subscription->is_offline)
                                    {{ $subscription->offline_download_limit ? $subscription->offline_download_limit . ' songs' : 'Unlimited' }}
                                  @else
                                    N/A
                                  @endif
                                </p>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_exclusivecontent ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_exclusivecontent ? 'Yes' : 'No' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_tip_artists ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_tip_artists ? 'Yes' : 'No' }}
                                </span>
                              </td>
                              <td>
                                <span class="badge {{ $subscription->is_supporter_badge ? 'bg-success' : 'bg-secondary' }}">
                                  {{ $subscription->is_supporter_badge ? 'Yes' : 'No' }}
                                </span>
                              </td>

                              <td>
                          <div class="product-action">

  <a class="square-white" href="{{ route('admin.subscription.edit', $subscription->id) }}">
    <svg>
      <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
    </svg>
  </a>


  <form action="{{ route('admin.subscription.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subscription plan?');" style="display:inline;">
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

@endforeach
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
