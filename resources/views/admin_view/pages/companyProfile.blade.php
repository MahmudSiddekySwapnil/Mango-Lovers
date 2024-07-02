@extends('admin_view.layouts.layouts')
@extends('admin_view.common.datatableHeader')
@section('container')
    <div class="content-page">
        <div class="content"> &nbsp;
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <div class="col-lg-12 ml-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="hstack gap-2 flex-wrap">
                                                            <button type="button" class="btn btn-primary"
                                                                    onclick="fetchDataAndPopulateModal()"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-bs-whatever="@getbootstrap">Company Profile
                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Company Service</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="recipient-name"
                                                                                       class="col-form-label">Title:</label>
                                                                                <input type="text"
                                                                                       class="form-control"
                                                                                       id="title">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="recipient-name"
                                                                                       class="col-form-label">Company Short Description
                                                                                </label>
                                                                                <textarea type="text"
                                                                                          class="form-control"
                                                                                          id="description"> </textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="message-text"
                                                                                       class="col-form-label">Company History</label>
                                                                                <textarea type="text"
                                                                                          class="form-control"
                                                                                          id="company_history"> </textarea>

                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="recipient-name"
                                                                                       class="col-form-label">Mission
                                                                                </label>
                                                                                <textarea type="text"
                                                                                          class="form-control"
                                                                                          id="mission"> </textarea>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text"
                                                                                       class="col-form-label">vission</label>
                                                                                <textarea type="text"
                                                                                          class="form-control"
                                                                                          id="vision"> </textarea>
                                                                            </div>


                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                        <button type="button" class="btn btn-primary"
                                                                               id="submitCompanyProfileForm">Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end card-body -->
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
        </div>
    </div>
    <script src="admin_assets/js/CompanyProfile.js"></script>

@endsection
