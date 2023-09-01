@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('settings.update', ['setting' => $settings->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Website</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="website_name">Website Name</label>
                            <input type="text" name="website_name" class="form-control" value="{{ old('website_name', $settings->website_name) }}" />
                            @error('website_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="website_url">Website URL</label>
                            <input type="text" name="website_url" class="form-control" value="{{ old('website_url', $settings->website_url) }}" />
                            @error('website_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="page_title">Page Title</label>
                            <input type="text" name="page_title" class="form-control" value="{{ old('page_title', $settings->page_title) }}" />
                            @error('page_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $settings->meta_keyword) }}" />
                                    @error('meta_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $settings->meta_description) }}" />
                                    @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="logotipo">Logotipo</label>
                                    <input type="file" name="logotipo" class="form-control" />
                                    @error('logotipo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <br />
                                    <img src="{{ asset($appSetting->logotipo) }}" style="height: 66px;">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Company Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $settings->company_name) }}" />
                            @error('company_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address1">Address 1</label>
                            <input type="text" name="address1" class="form-control" value="{{ old('address1', $settings->address1) }}" />
                            @error('address1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address2">Address 2</label>
                            <input type="text" name="address2" class="form-control" value="{{ old('address2', $settings->address2) }}" />
                            @error('address2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code', $settings->zip_code) }}" />
                            @error('zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country">Country</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country', $settings->country) }}" />
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>

                        <div class="col-md-6 mb-3">
                            <label for="phone1">Principal Phone</label>
                            <input type="tel" name="phone1" class="form-control" value="{{ old('phone1', $settings->phone1) }}" />
                            @error('phone1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone2">Second Phone</label>
                            <input type="tel" name="phone2" class="form-control" value="{{ old('phone2', $settings->phone2) }}" />
                            @error('phone2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone3">Whatsapp</label>
                            <input type="tel" name="phone3" class="form-control" value="{{ old('phone3', $settings->phone3) }}" />
                            @error('phone3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div></div>
                        <hr>
                        <div class="col-md-6 mb-3">
                            <label for="contact_email">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings->contact_email) }}" />
                            @error('contact_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin_email">Admin Email</label>
                            <input type="email" name="admin_email" class="form-control" value="{{ old('admin_email', $settings->admin_email) }}" />
                            @error('admin_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing_email">Billing Email</label>
                            <input type="email" name="billing_email" class="form-control" value="{{ old('billing_email', $settings->billing_email) }}" />
                            @error('billing_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Geral</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantity_unit">Quantity Unit</label>
                            <input type="text" name="quantity_unit" class="form-control" value="{{ old('quantity_unit', $settings->quantity_unit) }}" />
                            @error('quantity_unit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="shipping_mode">Shipping Mode</label>
                            <input type="text" name="shipping_mode" class="form-control" value="{{ old('shipping_mode', $settings->shipping_mode) }}" />
                            @error('shipping_mode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_mode">Payment Mode</label>
                            <input type="text" name="payment_mode" class="form-control" value="{{ old('payment_mode', $settings->payment_mode) }}" />
                            @error('payment_mode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="currency_type">Currency Type</label>
                            <input type="text" name="currency_type" class="form-control" value="{{ old('currency_type', $settings->currency_type) }}" />
                            @error('currency_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="banner_section">Banner Section</label>
                            <input type="text" name="banner_section" class="form-control" value="{{ old('banner_section', $settings->banner_section) }}" />
                            @error('banner_section')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="number_images_trending">Number of Images in Trending</label>
                            <input type="number" name="number_images_trending" class="form-control" value="{{ old('number_images_trending', $settings->number_images_trending) }}" />
                            @error('number_images_trending')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="py-1" for="format_date">Formato de data</label><br />

                            <input type='radio' name='format_date' value='Y-m-d' {{ $settings->format_date == 'Y-m-d' ? 'checked' : '' }} />
                            <span class="small">{{ now()->format('Y-m-d') }}</span><code>Y-m-d</code><br />
                            <input type='radio' name='format_date' value='Y-m-d' {{ $settings->format_date == 'Y-m-d' ? 'checked' : '' }} />
                            <span class="small">{{ now()->format('Y/m/d') }}</span><code>Y/m/d</code><br />
                            <input type='radio' name='format_date' value='m/d/Y' {{ $settings->format_date == 'm/d/Y' ? 'checked' : '' }} />
                            <span class="small">{{ now()->format('m/d/Y') }}</span><code>m/d/Y</code><br />

                            <input type='radio' name='format_date' value='d/m/Y' {{ $settings->format_date == 'd/m/Y' ? 'checked' : '' }} />
                            <span class="small">{{ now()->format('d/m/Y') }}</span><code>d/m/Y</code><br /><br />

                            <label class="py-1">Formato de hora</label><br />

                            <input type='radio' name='format_hour' value='H:i' {{ $settings->format_hour == 'H:i' ? 'checked' : '' }} />
                            <span class="small">16:09</span><code>H:i</code><br />

                            <input type='radio' name='format_hour' value='g:i A' {{ $settings->format_hour == 'g:i A' ? 'checked' : '' }} />
                            <span class="small">4:09 PM</span><code>g:i A</code>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="py-1">Formato de Número</label><br />

                            <input type="radio" name="format_number" value="0" {{ $settings->format_number == 0 ? 'checked' : '' }} />
                            <span class="small" class="number-format-text">1.234,56</span>
                            <code>#.###,##</code><br>

                            <input type="radio" name="format_number" value="1" {{ $settings->format_number == 1 ? 'checked' : '' }} />
                            <span class="small" class="number-format-text">1,234.56</span>
                            <code>#,###.##</code><br>

                            <input type="radio" name="format_number" value="2" {{ $settings->format_number == 2 ? 'checked' : '' }} />
                            <span class="small" class="number-format-text">1234,56</span>
                            <code>####,##</code><br>

                            <input type="radio" name="format_number" value="3" {{ $settings->format_number == 3 ? 'checked' : '' }} />
                            <span class="small" class="number-format-text">1234.56</span>
                            <code>####.##</code>
                        </div>


                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Tax Codes</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_name1">Tax Code Name 1</label>
                            <input type="text" name="tax_code_name1" class="form-control" value="{{ old('tax_code_name1', $settings->tax_code_name1) }}" />
                            @error('tax_code_name1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_value1">Tax Code Value 1</label>
                            <input type="text" name="tax_code_value1" class="form-control" value="{{ old('tax_code_value1', $settings->tax_code_value1) }}" />
                            @error('tax_code_value1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_name2">Tax Code Name 2</label>
                            <input type="text" name="tax_code_name2" class="form-control" value="{{ old('tax_code_name2', $settings->tax_code_name2) }}" />
                            @error('tax_code_name2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_value2">Tax Code Value 2</label>
                            <input type="text" name="tax_code_value2" class="form-control" value="{{ old('tax_code_value2', $settings->tax_code_value2) }}" />
                            @error('tax_code_value2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_name3">Tax Code Name 3</label>
                            <input type="text" name="tax_code_name3" class="form-control" value="{{ old('tax_code_name3', $settings->tax_code_name3) }}" />
                            @error('tax_code_name3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax_code_value3">Tax Code Value 3</label>
                            <input type="text" name="tax_code_value3" class="form-control" value="{{ old('tax_code_value3', $settings->tax_code_value3) }}" />
                            @error('tax_code_value3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Social Media</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="facebook">Facebook</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $settings->facebook) }}" />
                            @error('facebook')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="instagram">Instagram</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $settings->instagram) }}" />
                            @error('instagram')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="twitter">Twitter</label>
                            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $settings->twitter) }}" />
                            @error('twitter')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tiktok">Tiktok</label>
                            <input type="url" name="tiktok" class="form-control" value="{{ old('tiktok', $settings->tiktok) }}" />
                            @error('tiktok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="youtube">Youtube</label>
                            <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $settings->youtube) }}" />
                            @error('youtube')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-sm text-white">Save Settings</button>
            </div>

        </form>
    </div>
</div>

@endsection
