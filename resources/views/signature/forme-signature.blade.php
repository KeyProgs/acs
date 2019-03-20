<form method="post" action="http://api.signassur.com/" id="signature_form">
    <input type="hidden" name="merchant_id" value="{{$data['merchant_id']}}"/>
    <input type="hidden" name="application_key" value="{{$data['application_key']}}"/>
    <input type="hidden" name="transaction_id" id="transaction_id" value="{{$data['transaction_id']}}"/>
    <input type="hidden" name="customer_lastname" value="{{$data['customer_lastname']}}"/>
    <input type="hidden" name="customer_firstname" value="{{$data['customer_firstname']}}"/>
    <input type="hidden" name="customer_email" value="{{$data['customer_email']}}"/>
    <input type="hidden" name="return_email" value="{{$data['return_email']}}"/>
    <input type="hidden" name="merchant_logo" value="{{$data['merchant_logo']}}"/>
    <input type="hidden" name="cancel_return_url" value="{{$data['cancel_return_url']}}"/>
    <input type="hidden" name="normal_return_url" value="{{$data['normal_return_url']}}"/>
    <input type="hidden" name="response_return_url" value="{{$data['response_return_url']}}"/>
    <input type="hidden" name="doc_horodatage_url" value="{{$data['doc_horodatage_url']}}"/>
    <input type="hidden" name="doc_signature_url" value="{{$data['doc_signature_url']}}"/>
    <input type="submit" value="Je signe mon contrat en ligne" class="btn btn-success btn-next rounded-0"/>
</form>

