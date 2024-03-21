<div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h4 class="cate-title mb-0">Order Rate</h4>
                    <div class="row col-6">
                        <div class="mb-0">
                            <select wire:model="selectedYear" class="form-control default-select style-1 w-auto border">
                                <option value="">Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select wire:model="selectedMonth" wire:key="{{ $selectedYear }}" class="form-control default-select style-1 w-auto border">
                                <option value="">Month</option>
                                @foreach ($months as $month => $monthName)
                                    <option value="{{ $month }}">{{ $monthName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center flex md-nowrap flex-wrap mb-3 mb-md-0">
                        <div class="icon-bx bg-primary d-inline-block text-center me-3">
                            <svg width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 8.5C20 4.09 16.41 0.5 12 0.5C7.58998 0.5 3.99998 4.09 3.99998 8.5C3.99998 12.91 7.58998 16.5 12 16.5C16.41 16.5 20 12.91 20 8.5ZM6.99998 8.5C6.99998 5.74 9.23997 3.5 12 3.5C14.76 3.5 17 5.74 17 8.5C17 11.26 14.76 13.5 12 13.5C9.23997 13.5 6.99998 11.26 6.99998 8.5ZM14.4 18.5H9.59998C4.35998 18.5 0.0999756 22.76 0.0999756 28C0.0999756 28.83 0.769976 29.5 1.59998 29.5H22.4C23.23 29.5 23.9 28.83 23.9 28C23.9 22.76 19.64 18.5 14.4 18.5ZM3.26998 26.5C3.94998 23.64 6.52998 21.5 9.59998 21.5H14.4C17.47 21.5 20.05 23.64 20.73 26.5H3.26998Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="me-3">
                            <p class="mb-0">Order Total</p>
                            <h4 class="font-w600 mb-0">25.307</h4>
                        </div>
                        <div class="card style-3 m-0  mt-sm-0  mt-3 mt-sm-0 ms-md-0 ms-lg-3">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span>Target</span>
                                    <h6 class="font-w500 mb-0 data">3.982</h6>
                                </div>
                                <div class="progress default-progress">
                                    <div class="progress-bar bg-gradient1 progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                        <span class="sr-only">45% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <ul class="d-flex">
                                <li class="text-nowrap"><svg class="me-2" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6" cy="6.5" r="4.5" fill="white" stroke="#FC8019" stroke-width="3"/>
                                </svg>This Month
                                </li>
                            </ul>
                            <h4 class="font-w600 mb-0">1324</h4>
                        </div>
                        <div>
                            <ul class="d-flex">
                                <li class="text-nowrap"><svg class="me-2" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6" cy="6.5" r="4.5" fill="white" stroke="#EB5757" stroke-width="3"/>
                                </svg>Last Month
                                </li>
                            </ul>
                            <h4 class="mb-0 font-w600">1324</h4>
                        </div>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>

</div>
