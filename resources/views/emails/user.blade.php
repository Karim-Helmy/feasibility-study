@component('mail::message')
<h1>Welcome In Be-Steam Business Entrepreneurship</h1>
<br />
<h3 style="text-align:left; direction:ltr;">You have successfully activated your subscription and you can log in to our website through the following data:-</h3>
<p>Username: <span style="color:#FF0000">{{ $data->email }}</span>
<br />
<p>Password: <span style="color:#FF0000">{{ $data->pass }}</span>
<br />
<p>link: <span style="color:#FF0000">https://be-steam.com/</span>
<br />
<p>Important Notes: <span style="color:#FF0000; font-size:16px;">Please, you must change your password as soon as possible to protect your account</span>
<br /><br /><br />
Thanks,<br>
Be-Steam Adminstrator
<br />
admin@be-steam.com
<br />
0555644016
<br />
<img  src="{{ asset('backend/app-assets/images/logo/logo.png')}}" />
@endcomponent
