@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $kyc = getContent('user_kyc.content', true);
    @endphp
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    @if ($user->kv == 0)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--danger">@lang('KYC Verification required')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->verification_content) }} <a class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                        </div>
                    @elseif($user->kv == 2)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--warning">@lang('KYC Verification pending')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->pending_content) }} <a class="text--base" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @if (Auth::user()->nft)
            <a href="{{getImage(getFilePath('nft')."/". Auth::user()->nft)  }}" target="_blank" class ="text-white" rel="noopener noreferrer"><h5>My NFT</h5> </a>
            @endif --}}
            <div class="row mb-3">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-balance">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-wave"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Balance')</p>
                            <h2 class="title">{{ showAmount($widget['total_balance']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-deposit">
                        <div class="d-widget-icon">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Deposit')</p>
                            <h2 class="title">{{ showAmount($widget['total_deposit']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-withdraw">
                        <div class="d-widget-icon">
                            <i class="las la-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Withdraw')</p>
                            <h2 class="title">{{ showAmount($widget['total_withdrawn']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-invest">
                        <div class="d-widget-icon">
                            <i class="las la-cash-register"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Invest')</p>
                            <h2 class="title">{{ showAmount($widget['total_invest']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-win">
                        <div class="d-widget-icon">
                            <i class="las la-trophy"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Win')</p>
                            <h2 class="title">{{ showAmount($widget['total_win']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-loss">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-alt"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Loss')</p>
                            <h2 class="title">{{ showAmount($widget['total_loss']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @forelse($games as $game)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                        <div class="game-card style--two">
                            <div class="game-card__thumb">
                                <img src="{{ getImage(getFilePath('game') . '/' . $game->image, getFileSize('game')) }}" alt="image">
                            </div>
                            <div class="game-card__content">
                                <h4 class="game-name">{{ __($game->name) }}</h4>
                                <a class="cmn-btn d-block btn-sm btn--capsule mt-3 text-center" href="{{ route('user.play.game', $game->alias) }}">@lang('Play Now')</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">{{ __($emptyMessage) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if (Auth::user()->nft==NULL)

    <div class="modal fade" id="cronModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('NFT Uploading Instruction')</h5>
                    <span class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></span>
                </div>
                <div class="modal-body">
                    <h3 class="text--danger text-center">@lang('To Earn Your Welcome Bonus')</h3>
                    <p class="text-dark">
                        @lang('To complete all incomplete games, we need to set the cron job and make sure the cron job is running properly. Set the Cron time as minimum as possible. Once per 5-15 minutes is ideal while once every minute is the best option.') </p>
                        {{-- <form action="submitNFT" method="post" enctype="multipart/form-data">
                            @csrf
                            <label class="font-weight-bold">@lang('Cron Command')</label>
                            <div class="input-group">
                            <input class="form-control form-control"  name="nft" type="file">
                            <input type="submit" value="Submit NTF" class="input-group-text d-block copytext btn--primary copyBoard border-0">
                        </div>
                        </form> --}}
                        <div class="text-center">
                            <button type="button"  class="btn input-group-text copytext btn--primary  copyBoard mt-4 payNFT">Continue Your Payment</button>

                        </div>

                </div>
            </div>
        </div>
    </div>

    @endif

@endsection

@push('script')

@if (Auth::user()->txHash==NULL)

<script>
    $(document).ready(function() {
            var time = `{{ Carbon\Carbon::parse($general->last_cron)->diffInMinutes() }}`;
            if (time > 15) {
                $("#cronModal").modal('show')
            }
        });

        // function startProcess() {
        //     if ($('#inp_amount').val()) {
        //         // run metamsk functions here
        //         EThAppDeploy.loadEtherium();
        //     } else {
        //         alert('Please Enter Valid Amount');
        //     }
        // }

        $(".payNFT").click(function(){
            EThAppDeploy.loadEtherium();
        })



        EThAppDeploy = {
            loadEtherium: async () => {
                if (typeof window.ethereum !== 'undefined') {
                    EThAppDeploy.web3Provider = ethereum;
                    EThAppDeploy.requestAccount(ethereum);
                } else {
                    alert(
                        "Not able to locate an Ethereum connection, please install a Metamask wallet"
                    );
                }
            },
            /****
             * Request A Account
             * **/
            requestAccount: async (ethereum) => {
                ethereum
                    .request({
                        method: 'eth_requestAccounts'
                    })
                    .then((resp) => {
                        //do payments with activated account
                        EThAppDeploy.payNow(ethereum, resp[0]);
                    })
                    .catch((err) => {
                        // Some unexpected error.
                        // console.log(err);
                        alert(err);
                    });
            },
            /***
             *
             * Do Payment
             * */
            payNow: async (ethereum, from) => {
                var amount = "{{ env('ETH_PAYMENT') }}"; //$('#inp_amount').val();
                ethereum
                    .request({
                        method: 'eth_sendTransaction',
                        params: [{
                            from: from,
                            to: "{{ env('MY_WALLET') }}",
                            value: '0x' + ((amount * 1000000000000000000).toString(16)),
                        }, ],
                    })
                    .then((txHash) => {
                        if (txHash) {
                            console.log(txHash);
                            storeTransaction(txHash, amount);
                        } else {
                            // console.log("error 2");
                            alert("Something went wrong. Please try again");
                        }
                    })
                    .catch((error) => {
                        // console.log("error");
                        // console.log(error);
                        alert(error.message);
                    });
            },
        }
        /***
         *
         * @param Transaction id
         *
         */
        function storeTransaction(txHash, amount) {
            $.ajax({
                url: "{{ 'submitNFT' }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    txHash: txHash,
                    amount: amount,
                },
                success: function (response) {
                    // reload page after success
                    window.location.reload();
                }
            });
        }


</script>
@endif

@endpush
