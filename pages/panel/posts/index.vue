<template>
  <div>
    <!-- Container -->
    <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
      <!-- Row -->
      <div class="row">
        <div class="col-xl-12">
          <div class="hk-row">
            <div class="col-lg-7">
              <div class="card card-refresh">
                <div class="refresh-container">
                  <div class="loader-pendulums"></div>
                </div>
                <div class="card-header card-header-action">
                  <div>
                    <h6 class="mb-10">Monthly Inflation in Argentina, 2002</h6>
                    <p class="font-14 w-80">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore.
                    </p>
                  </div>
                  <div class="d-flex align-items-center card-action-wrap">
                    <a href="#" class="inline-block refresh mr-15">
                      <i class="ion ion-md-radio-button-off"></i>
                    </a>
                    <div class="inline-block dropdown">
                      <a
                        class="dropdown-toggle no-caret"
                        data-toggle="dropdown"
                        href="#"
                        aria-expanded="false"
                        role="button"
                        ><i class="ion ion-md-more"></i
                      ></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="e_chart_1"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header card-header-action">
                  <div>
                    <h6 class="mb-10">Stock Price Movement</h6>
                    <p class="font-14 w-80">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                  </div>
                  <div class="d-flex align-items-center card-action-wrap">
                    <div class="inline-block dropdown">
                      <a
                        class="dropdown-toggle no-caret"
                        data-toggle="dropdown"
                        href="#"
                        aria-expanded="false"
                        role="button"
                        ><i class="ion ion-ios-more"></i
                      ></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="e_chart_2" style="height: 250px"></div>
                  <div class="hk-legend-wrap mt-20">
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-3
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>18-24</span>
                    </div>
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-4
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>25-34</span>
                    </div>
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-5
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>35-44</span>
                    </div>
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-2
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>45-54</span>
                    </div>
                    <div class="hk-legend">
                      <span
                        class="d-10 bg-light-20 rounded-circle d-inline-block"
                      ></span
                      ><span>55-64</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hk-row">
            <div class="col-lg-3 col-md-6">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="d-flex justify-content-between mb-5">
                    <div>
                      <span class="d-block font-15 text-dark font-weight-500"
                        >Users</span
                      >
                    </div>
                    <div>
                      <span class="text-success font-14 font-weight-500"
                        >+10%</span
                      >
                    </div>
                  </div>
                  <div class="text-center">
                    <span class="d-block display-4 text-dark mb-5">168M</span>
                    <small class="d-block">172,458 Target Users</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="d-flex justify-content-between mb-5">
                    <div>
                      <span class="d-block font-15 text-dark font-weight-500"
                        >Campaign Leads</span
                      >
                    </div>
                    <div>
                      <span class="text-success font-14 font-weight-500"
                        >+12.5%</span
                      >
                    </div>
                  </div>
                  <div class="text-center">
                    <span class="d-block display-4 text-dark mb-5"
                      ><span class="counter-anim">168,856</span></span
                    >
                    <small class="d-block">472,458 Targeted</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="d-flex justify-content-between mb-5">
                    <div>
                      <span class="d-block font-15 text-dark font-weight-500"
                        >New Contacts</span
                      >
                    </div>
                    <div>
                      <span class="text-warning font-14 font-weight-500"
                        >-2.8%</span
                      >
                    </div>
                  </div>
                  <div class="text-center">
                    <span class="d-block display-4 text-dark mb-5">73</span>
                    <small class="d-block">100 Targeted</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="d-flex justify-content-between mb-5">
                    <div>
                      <span class="d-block font-15 text-dark font-weight-500"
                        >Win/Loss Ratio</span
                      >
                    </div>
                    <div>
                      <span class="text-danger font-14 font-weight-500"
                        >-75%</span
                      >
                    </div>
                  </div>
                  <div class="text-center">
                    <span class="d-block display-4 text-dark mb-5">48:65</span>
                    <small class="d-block">42:32 Targeted</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hk-row">
            <div class="col-lg-7">
              <div class="card">
                <div class="card-header card-header-action">
                  <h6>
                    Country Stats<small class="text-muted pl-10"
                      >sub heading</small
                    >
                  </h6>
                  <div class="d-flex align-items-center card-action-wrap">
                    <a href="#" class="inline-block refresh mr-15">
                      <i class="ion ion-md-arrow-down"></i>
                    </a>
                    <a href="#" class="inline-block full-screen">
                      <i class="ion ion-md-expand"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body pa-0">
                  <div class="pa-20">
                    <div id="regions_selection" style="height: 390px"></div>
                  </div>
                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table table-sm table-hover mb-0">
                        <thead>
                          <tr>
                            <th class="w-25">Country</th>
                            <th>Sessions</th>
                            <th>Goals</th>
                            <th>Goals Rate</th>
                            <th>Bounce Rate</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Canada</td>
                            <td>55,555</td>
                            <td>210</td>
                            <td>2.46%</td>
                            <td>0.26%</td>
                          </tr>
                          <tr>
                            <td>India</td>
                            <td>24,152</td>
                            <td>135</td>
                            <td>0.58%</td>
                            <td>0.43%</td>
                          </tr>
                          <tr>
                            <td>UK</td>
                            <td>15,640</td>
                            <td>324</td>
                            <td>5.15%</td>
                            <td>2.47%</td>
                          </tr>
                          <tr>
                            <td>Botswana</td>
                            <td>12,148</td>
                            <td>854</td>
                            <td>4.19%</td>
                            <td>0.1%</td>
                          </tr>
                          <tr>
                            <td>UAE</td>
                            <td>11,258</td>
                            <td>453</td>
                            <td>8.15%</td>
                            <td>0.14%</td>
                          </tr>
                          <tr>
                            <td>Australia</td>
                            <td>10,786</td>
                            <td>376</td>
                            <td>5.48%</td>
                            <td>0.45%</td>
                          </tr>
                          <tr>
                            <td>Phillipines</td>
                            <td>9,485</td>
                            <td>63</td>
                            <td>3.51%</td>
                            <td>0.9%</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header card-header-action">
                  <div>
                    <h6 class="mb-10">Ratings & Reviews</h6>
                    <p class="font-14 w-80">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore.
                    </p>
                  </div>
                  <div class="d-flex align-items-center card-action-wrap">
                    <button class="btn btn-secondary btn-sm">
                      Rate the template
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5">
                      <div
                        class="
                          d-flex
                          align-items-center
                          h-100
                          justify-content-center
                          text-center
                        "
                      >
                        <div>
                          <div
                            class="
                              d-flex
                              align-items-center
                              justify-content-center
                              text-dark
                            "
                          >
                            <span class="counter-anim display-2">4.4</span>
                            <span class="review-star starred ml-10">
                              <i class="fa fa-star"></i
                            ></span>
                          </div>
                          <span class="font-18">949 ratings & 18 reviews</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="progress-wrap lb-side-left mt-5">
                        <div class="progress-lb-wrap mb-10">
                          <label class="progress-label mnw-50p"
                            >5.0<i class="zmdi zmdi-star text-light-20 ml-5"></i
                          ></label>
                          <div
                            class="
                              progress progress-bar-rounded progress-bar-xs
                            "
                          >
                            <div
                              class="progress-bar bg-success w-85"
                              role="progressbar"
                              aria-valuenow="85"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                          <label class="progress-label mnw-50p"
                            >4.0<i class="zmdi zmdi-star text-light-20 ml-5"></i
                          ></label>
                          <div
                            class="
                              progress progress-bar-rounded progress-bar-xs
                            "
                          >
                            <div
                              class="progress-bar bg-primary w-75"
                              role="progressbar"
                              aria-valuenow="75"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                          <label class="progress-label mnw-50p"
                            >3.0<i class="zmdi zmdi-star text-light-20 ml-5"></i
                          ></label>
                          <div
                            class="
                              progress progress-bar-rounded progress-bar-xs
                            "
                          >
                            <div
                              class="progress-bar bg-warning w-65"
                              role="progressbar"
                              aria-valuenow="65"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                          <label class="progress-label mnw-50p"
                            >2.0<i class="zmdi zmdi-star text-light-20 ml-5"></i
                          ></label>
                          <div
                            class="
                              progress progress-bar-rounded progress-bar-xs
                            "
                          >
                            <div
                              class="progress-bar bg-warning w-55"
                              role="progressbar"
                              aria-valuenow="55"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                          <label class="progress-label mnw-50p"
                            >1.0<i class="zmdi zmdi-star text-light-20 ml-5"></i
                          ></label>
                          <div
                            class="
                              progress progress-bar-rounded progress-bar-xs
                            "
                          >
                            <div
                              class="progress-bar bg-danger w-25"
                              role="progressbar"
                              aria-valuenow="25"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body pa-0">
                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0">
                        <thead>
                          <tr>
                            <th>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck4"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck4"
                                  >Lead Title</label
                                >
                              </div>
                            </th>
                            <th>Sales</th>
                            <th>Company</th>
                            <th>Date Created</th>
                            <th>Lead Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck41"
                                  checked=""
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck41"
                                  ><span class="w-130p d-block text-truncate"
                                    >connar_weiked@ae.com</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$2000</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-primary
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>A</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">American Express</span>
                                </div>
                              </div>
                            </td>
                            <td>22/10/2018</td>
                            <td>
                              <span class="badge badge-soft-primary"
                                >On track</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck42"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck42"
                                  ><span class="w-130p d-block text-truncate"
                                    >express_notingham@em.au</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$1600</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-danger
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>M</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">Exxon Mobil</span>
                                </div>
                              </div>
                            </td>
                            <td>15/09/2018</td>
                            <td>
                              <span class="badge badge-soft-primary"
                                >On track</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck43"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck43"
                                  ><span class="w-130p d-block text-truncate"
                                    >locast12_host@nova.com</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$1265</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-teal
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>B</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">Big Blackship</span>
                                </div>
                              </div>
                            </td>
                            <td>30/08/2018</td>
                            <td>
                              <span class="badge badge-soft-danger"
                                >Behind</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck44"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck44"
                                  ><span class="w-130p d-block text-truncate"
                                    >grillmac@sundance.co.in</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$4562</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-indigo
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>F</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">Folkswagan</span>
                                </div>
                              </div>
                            </td>
                            <td>14/03/2018</td>
                            <td>
                              <span class="badge badge-soft-purple"
                                >Negotiation</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck45"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck45"
                                  ><span class="w-130p d-block text-truncate"
                                    >admin@novotel.inc</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$5012</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-purple
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>N</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">Novotel</span>
                                </div>
                              </div>
                            </td>
                            <td>21/02/2018</td>
                            <td>
                              <span class="badge badge-soft-orange"
                                >Offer Made</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div
                                class="
                                  custom-control custom-checkbox
                                  checkbox-primary
                                "
                              >
                                <input
                                  type="checkbox"
                                  class="custom-control-input"
                                  id="customCheck46"
                                />
                                <label
                                  class="custom-control-label"
                                  for="customCheck46"
                                  ><span class="w-130p d-block text-truncate"
                                    >displaypic@ho.au</span
                                  ></label
                                >
                              </div>
                            </td>
                            <td>$1245</td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-img-wrap d-flex mr-10">
                                  <div class="avatar avatar-xs">
                                    <span
                                      class="
                                        avatar-text avatar-text-pink
                                        rounded-circle
                                      "
                                      ><span class="initial-wrap"
                                        ><span>D</span></span
                                      ></span
                                    >
                                  </div>
                                </div>
                                <div class="media-body">
                                  <span class="d-block">Displaypic</span>
                                </div>
                              </div>
                            </td>
                            <td>3/02/2018</td>
                            <td>
                              <span class="badge badge-soft-orange"
                                >Offer Made</span
                              >
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header card-header-action">
                  <h6>Linkedin Key Metrics</h6>
                  <div class="d-flex align-items-center card-action-wrap">
                    <a href="#" class="inline-block refresh mr-15">
                      <i class="ion ion-md-arrow-down"></i>
                    </a>
                    <a href="#" class="inline-block full-screen mr-15">
                      <i class="ion ion-md-expand"></i>
                    </a>
                    <a
                      class="inline-block card-close"
                      href="#"
                      data-effect="fadeOut"
                    >
                      <i class="ion ion-md-close"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body pa-0">
                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table table-sm table-hover mb-0">
                        <thead>
                          <tr>
                            <th>Metrics</th>
                            <th class="w-40">Period</th>
                            <th class="w-25">Past</th>
                            <th>Trend</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Clicks</td>
                            <td>
                              <div class="progress-wrap lb-side-left mnw-125p">
                                <div class="progress-lb-wrap">
                                  <label class="progress-label mnw-50p"
                                    >1,184</label
                                  >
                                  <div
                                    class="
                                      progress
                                      progress-bar-rounded
                                      progress-bar-xs
                                    "
                                  >
                                    <div
                                      class="progress-bar bg-primary w-70"
                                      role="progressbar"
                                      aria-valuenow="70"
                                      aria-valuemin="0"
                                      aria-valuemax="100"
                                    ></div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>1,234</td>
                            <td><div id="sparkline_1"></div></td>
                          </tr>
                          <tr>
                            <td>Visits</td>
                            <td>
                              <div class="progress-wrap lb-side-left mnw-125p">
                                <div class="progress-lb-wrap">
                                  <label class="progress-label mnw-50p"
                                    >1,425</label
                                  >
                                  <div
                                    class="
                                      progress
                                      progress-bar-rounded
                                      progress-bar-xs
                                    "
                                  >
                                    <div
                                      class="progress-bar bg-success w-70"
                                      role="progressbar"
                                      aria-valuenow="70"
                                      aria-valuemin="0"
                                      aria-valuemax="100"
                                    ></div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>3,458</td>
                            <td><div id="sparkline_2"></div></td>
                          </tr>
                          <tr>
                            <td>Views</td>
                            <td>
                              <div class="progress-wrap lb-side-left mnw-125p">
                                <div class="progress-lb-wrap">
                                  <label class="progress-label mnw-50p"
                                    >5,623</label
                                  >
                                  <div
                                    class="
                                      progress
                                      progress-bar-rounded
                                      progress-bar-xs
                                    "
                                  >
                                    <div
                                      class="progress-bar bg-warning w-60"
                                      role="progressbar"
                                      aria-valuenow="70"
                                      aria-valuemin="0"
                                      aria-valuemax="100"
                                    ></div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>53,637</td>
                            <td><div id="sparkline_3"></div></td>
                          </tr>
                          <tr>
                            <td>Returns</td>
                            <td>
                              <div class="progress-wrap lb-side-left mnw-125p">
                                <div class="progress-lb-wrap">
                                  <label class="progress-label mnw-50p"
                                    >4,851</label
                                  >
                                  <div
                                    class="
                                      progress
                                      progress-bar-rounded
                                      progress-bar-xs
                                    "
                                  >
                                    <div
                                      class="progress-bar bg-danger w-55"
                                      role="progressbar"
                                      aria-valuenow="70"
                                      aria-valuemin="0"
                                      aria-valuemax="100"
                                    ></div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>20,596</td>
                            <td><div id="sparkline_4"></div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header card-header-action">
                  <h6>Average High & Low Temperature</h6>
                  <div class="d-flex align-items-center card-action-wrap">
                    <div class="inline-block dropdown">
                      <a
                        class="dropdown-toggle no-caret"
                        data-toggle="dropdown"
                        href="#"
                        aria-expanded="false"
                        role="button"
                        ><i class="ion ion-ios-more"></i
                      ></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="hk-legend-wrap mb-20">
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-4
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>Sessions</span>
                    </div>
                    <div class="hk-legend">
                      <span
                        class="
                          d-10
                          bg-pink-light-3
                          rounded-circle
                          d-inline-block
                        "
                      ></span
                      ><span>Pageviews</span>
                    </div>
                  </div>
                  <div id="e_chart_3"></div>
                </div>
              </div>
              <div class="card overflow-hide border-0">
                <div class="card-body pa-0">
                  <div
                    id="owl_demo_1"
                    class="owl-carousel dots-on-item owl-theme"
                  >
                    <div
                      class="
                        fadeOut
                        item
                        img-background
                        overlay-wrap
                        bg-gradient-citrine
                      "
                    >
                      <div class="position-relative z-index-2 pa-20">
                        <div class="position-relative text-white mnh-225p">
                          <p>
                            Very easy to use. Thanks to design, we've just
                            launched our 5th website! Thank you for making it
                            painless, pleasant and most of all hassle free! Just
                            what I was looking for.
                          </p>
                          <div
                            class="
                              media
                              position-absolute
                              b-0
                              l-0
                              align-items-center
                            "
                          >
                            <div class="media-img-wrap d-flex mr-15">
                              <div class="avatar avatar-sm">
                                <span
                                  class="
                                    avatar-text avatar-text-inv-pink
                                    rounded-circle
                                  "
                                  ><span class="initial-wrap"
                                    ><span>ZC</span></span
                                  ></span
                                >
                              </div>
                            </div>
                            <div class="media-body">
                              <span class="d-block font-14 font-weight-500"
                                >Zuck Chan</span
                              >
                              <span class="d-block font-12"
                                >Design Lead, Hencework</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bg-overlay bg-trans-dark-50"></div>
                    </div>
                    <div
                      class="
                        fadeOut
                        item
                        img-background
                        overlay-wrap
                        bg-gradient-citrine
                      "
                    >
                      <div class="position-relative z-index-2 pa-20">
                        <div class="position-relative text-white mnh-225p">
                          <p>
                            Nice work on your design. Design is worth much more
                            than I paid. We've used design for the last five
                            years. I just can't get enough of design.
                          </p>
                          <div
                            class="
                              media
                              position-absolute
                              b-0
                              l-0
                              align-items-center
                            "
                          >
                            <div class="media-img-wrap d-flex mr-15">
                              <div class="avatar avatar-sm">
                                <span
                                  class="
                                    avatar-text avatar-text-inv-primary
                                    rounded-circle
                                  "
                                  ><span class="initial-wrap"
                                    ><span>NT</span></span
                                  ></span
                                >
                              </div>
                            </div>
                            <div class="media-body">
                              <span class="d-block font-14 font-weight-500"
                                >Normand T.</span
                              >
                              <span class="d-block font-12"
                                >Sales Executive, Media</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bg-overlay bg-trans-dark-50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="hk-row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4"></div>
          </div>
        </div>
      </div>
      <!-- /Row -->
    </div>
    <!-- /Container -->
  </div>
</template>
<script>
export default {
  layout: "admin",
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();
      $(".preloader-it").delay(500).fadeOut("slow");
      setTimeout(() => {
        this.$nuxt.$loading.finish();
        $(".hk-wrapper").removeClass("d-none");
      }, 1000);
    });
  },
};
</script>