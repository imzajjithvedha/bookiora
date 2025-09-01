@props(['data'])

@php
    $country = old($data) ?? ($data ?? '');
@endphp

<option value="">Select Country</option>
<option value="Afghanistan" {{ $country == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
<option value="Albania" {{ $country == 'Albania' ? 'selected' : '' }}>Albania</option>
<option value="Algeria" {{ $country == 'Algeria' ? 'selected' : '' }}>Algeria</option>
<option value="Andorra" {{ $country == 'Andorra' ? 'selected' : '' }}>Andorra</option>
<option value="Angola" {{ $country == 'Angola' ? 'selected' : '' }}>Angola</option>
<option value="Antigua and Barbuda" {{ $country == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
<option value="Argentina" {{ $country == 'Argentina' ? 'selected' : '' }}>Argentina</option>
<option value="Armenia" {{ $country == 'Armenia' ? 'selected' : '' }}>Armenia</option>
<option value="Australia" {{ $country == 'Australia' ? 'selected' : '' }}>Australia</option>
<option value="Austria" {{ $country == 'Austria' ? 'selected' : '' }}>Austria</option>
<option value="Azerbaijan" {{ $country == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
<option value="Bahamas" {{ $country == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
<option value="Bahrain" {{ $country == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
<option value="Bangladesh" {{ $country == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
<option value="Barbados" {{ $country == 'Barbados' ? 'selected' : '' }}>Barbados</option>
<option value="Belarus" {{ $country == 'Belarus' ? 'selected' : '' }}>Belarus</option>
<option value="Belgium" {{ $country == 'Belgium' ? 'selected' : '' }}>Belgium</option>
<option value="Belize" {{ $country == 'Belize' ? 'selected' : '' }}>Belize</option>
<option value="Benin" {{ $country == 'Benin' ? 'selected' : '' }}>Benin</option>
<option value="Bhutan" {{ $country == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
<option value="Bolivia" {{ $country == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
<option value="Bosnia and Herzegovina" {{ $country == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
<option value="Botswana" {{ $country == 'Botswana' ? 'selected' : '' }}>Botswana</option>
<option value="Brazil" {{ $country == 'Brazil' ? 'selected' : '' }}>Brazil</option>
<option value="Brunei" {{ $country == 'Brunei' ? 'selected' : '' }}>Brunei</option>
<option value="Bulgaria" {{ $country == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
<option value="Burkina Faso" {{ $country == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
<option value="Burundi" {{ $country == 'Burundi' ? 'selected' : '' }}>Burundi</option>
<option value="Cambodia" {{ $country == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
<option value="Cameroon" {{ $country == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
<option value="Canada" {{ $country == 'Canada' ? 'selected' : '' }}>Canada</option>
<option value="Cape Verde" {{ $country == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
<option value="Central African Republic" {{ $country == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
<option value="Chad" {{ $country == 'Chad' ? 'selected' : '' }}>Chad</option>
<option value="Chile" {{ $country == 'Chile' ? 'selected' : '' }}>Chile</option>
<option value="China" {{ $country == 'China' ? 'selected' : '' }}>China</option>
<option value="Colombia" {{ $country == 'Colombia' ? 'selected' : '' }}>Colombia</option>
<option value="Comoros" {{ $country == 'Comoros' ? 'selected' : '' }}>Comoros</option>
<option value="Congo (Brazzaville)" {{ $country == 'Congo (Brazzaville)' ? 'selected' : '' }}>Congo (Brazzaville)</option>
<option value="Congo (Kinshasa)" {{ $country == 'Congo (Kinshasa)' ? 'selected' : '' }}>Congo (Kinshasa)</option>
<option value="Costa Rica" {{ $country == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
<option value="Croatia" {{ $country == 'Croatia' ? 'selected' : '' }}>Croatia</option>
<option value="Cuba" {{ $country == 'Cuba' ? 'selected' : '' }}>Cuba</option>
<option value="Cyprus" {{ $country == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
<option value="Czech Republic" {{ $country == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
<option value="Denmark" {{ $country == 'Denmark' ? 'selected' : '' }}>Denmark</option>
<option value="Djibouti" {{ $country == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
<option value="Dominica" {{ $country == 'Dominica' ? 'selected' : '' }}>Dominica</option>
<option value="Dominican Republic" {{ $country == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
<option value="Ecuador" {{ $country == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
<option value="Egypt" {{ $country == 'Egypt' ? 'selected' : '' }}>Egypt</option>
<option value="El Salvador" {{ $country == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
<option value="Equatorial Guinea" {{ $country == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
<option value="Eritrea" {{ $country == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
<option value="Estonia" {{ $country == 'Estonia' ? 'selected' : '' }}>Estonia</option>
<option value="Eswatini" {{ $country == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
<option value="Ethiopia" {{ $country == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
<option value="Fiji" {{ $country == 'Fiji' ? 'selected' : '' }}>Fiji</option>
<option value="Finland" {{ $country == 'Finland' ? 'selected' : '' }}>Finland</option>
<option value="France" {{ $country == 'France' ? 'selected' : '' }}>France</option>
<option value="Gabon" {{ $country == 'Gabon' ? 'selected' : '' }}>Gabon</option>
<option value="Gambia" {{ $country == 'Gambia' ? 'selected' : '' }}>Gambia</option>
<option value="Georgia" {{ $country == 'Georgia' ? 'selected' : '' }}>Georgia</option>
<option value="Germany" {{ $country == 'Germany' ? 'selected' : '' }}>Germany</option>
<option value="Ghana" {{ $country == 'Ghana' ? 'selected' : '' }}>Ghana</option>
<option value="Greece" {{ $country == 'Greece' ? 'selected' : '' }}>Greece</option>
<option value="Grenada" {{ $country == 'Grenada' ? 'selected' : '' }}>Grenada</option>
<option value="Guatemala" {{ $country == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
<option value="Guinea" {{ $country == 'Guinea' ? 'selected' : '' }}>Guinea</option>
<option value="Guinea-Bissau" {{ $country == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
<option value="Guyana" {{ $country == 'Guyana' ? 'selected' : '' }}>Guyana</option>
<option value="Haiti" {{ $country == 'Haiti' ? 'selected' : '' }}>Haiti</option>
<option value="Honduras" {{ $country == 'Honduras' ? 'selected' : '' }}>Honduras</option>
<option value="Hungary" {{ $country == 'Hungary' ? 'selected' : '' }}>Hungary</option>
<option value="Iceland" {{ $country == 'Iceland' ? 'selected' : '' }}>Iceland</option>
<option value="India" {{ $country == 'India' ? 'selected' : '' }}>India</option>
<option value="Indonesia" {{ $country == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
<option value="Iran" {{ $country == 'Iran' ? 'selected' : '' }}>Iran</option>
<option value="Iraq" {{ $country == 'Iraq' ? 'selected' : '' }}>Iraq</option>
<option value="Ireland" {{ $country == 'Ireland' ? 'selected' : '' }}>Ireland</option>
<option value="Israel" {{ $country == 'Israel' ? 'selected' : '' }}>Israel</option>
<option value="Italy" {{ $country == 'Italy' ? 'selected' : '' }}>Italy</option>
<option value="Jamaica" {{ $country == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
<option value="Japan" {{ $country == 'Japan' ? 'selected' : '' }}>Japan</option>
<option value="Jordan" {{ $country == 'Jordan' ? 'selected' : '' }}>Jordan</option>
<option value="Kazakhstan" {{ $country == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
<option value="Kenya" {{ $country == 'Kenya' ? 'selected' : '' }}>Kenya</option>
<option value="Kiribati" {{ $country == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
<option value="Kuwait" {{ $country == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
<option value="Kyrgyzstan" {{ $country == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
<option value="Laos" {{ $country == 'Laos' ? 'selected' : '' }}>Laos</option>
<option value="Latvia" {{ $country == 'Latvia' ? 'selected' : '' }}>Latvia</option>
<option value="Lebanon" {{ $country == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
<option value="Lesotho" {{ $country == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
<option value="Liberia" {{ $country == 'Liberia' ? 'selected' : '' }}>Liberia</option>
<option value="Libya" {{ $country == 'Libya' ? 'selected' : '' }}>Libya</option>
<option value="Liechtenstein" {{ $country == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
<option value="Lithuania" {{ $country == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
<option value="Luxembourg" {{ $country == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
<option value="Madagascar" {{ $country == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
<option value="Malawi" {{ $country == 'Malawi' ? 'selected' : '' }}>Malawi</option>
<option value="Malaysia" {{ $country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
<option value="Maldives" {{ $country == 'Maldives' ? 'selected' : '' }}>Maldives</option>
<option value="Mali" {{ $country == 'Mali' ? 'selected' : '' }}>Mali</option>
<option value="Malta" {{ $country == 'Malta' ? 'selected' : '' }}>Malta</option>
<option value="Marshall Islands" {{ $country == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
<option value="Mauritania" {{ $country == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
<option value="Mauritius" {{ $country == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
<option value="Mexico" {{ $country == 'Mexico' ? 'selected' : '' }}>Mexico</option>
<option value="Micronesia" {{ $country == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
<option value="Moldova" {{ $country == 'Moldova' ? 'selected' : '' }}>Moldova</option>
<option value="Monaco" {{ $country == 'Monaco' ? 'selected' : '' }}>Monaco</option>
<option value="Mongolia" {{ $country == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
<option value="Montenegro" {{ $country == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
<option value="Morocco" {{ $country == 'Morocco' ? 'selected' : '' }}>Morocco</option>
<option value="Mozambique" {{ $country == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
<option value="Myanmar" {{ $country == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
<option value="Namibia" {{ $country == 'Namibia' ? 'selected' : '' }}>Namibia</option>
<option value="Nauru" {{ $country == 'Nauru' ? 'selected' : '' }}>Nauru</option>
<option value="Nepal" {{ $country == 'Nepal' ? 'selected' : '' }}>Nepal</option>
<option value="Netherlands" {{ $country == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
<option value="New Zealand" {{ $country == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
<option value="Nicaragua" {{ $country == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
<option value="Niger" {{ $country == 'Niger' ? 'selected' : '' }}>Niger</option>
<option value="Nigeria" {{ $country == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
<option value="North Korea" {{ $country == 'North Korea' ? 'selected' : '' }}>North Korea</option>
<option value="North Macedonia" {{ $country == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
<option value="Norway" {{ $country == 'Norway' ? 'selected' : '' }}>Norway</option>
<option value="Oman" {{ $country == 'Oman' ? 'selected' : '' }}>Oman</option>
<option value="Pakistan" {{ $country == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
<option value="Palau" {{ $country == 'Palau' ? 'selected' : '' }}>Palau</option>
<option value="Palestine" {{ $country == 'Palestine' ? 'selected' : '' }}>Palestine</option>
<option value="Panama" {{ $country == 'Panama' ? 'selected' : '' }}>Panama</option>
    <option value="Papua New Guinea" {{ $country == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
<option value="Paraguay" {{ $country == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
<option value="Peru" {{ $country == 'Peru' ? 'selected' : '' }}>Peru</option>
<option value="Philippines" {{ $country == 'Philippines' ? 'selected' : '' }}>Philippines</option>
<option value="Poland" {{ $country == 'Poland' ? 'selected' : '' }}>Poland</option>
<option value="Portugal" {{ $country == 'Portugal' ? 'selected' : '' }}>Portugal</option>
<option value="Qatar" {{ $country == 'Qatar' ? 'selected' : '' }}>Qatar</option>
<option value="Romania" {{ $country == 'Romania' ? 'selected' : '' }}>Romania</option>
<option value="Russia" {{ $country == 'Russia' ? 'selected' : '' }}>Russia</option>
<option value="Rwanda" {{ $country == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
<option value="Saint Kitts and Nevis" {{ $country == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
<option value="Saint Lucia" {{ $country == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
<option value="Saint Vincent and the Grenadines" {{ $country == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
<option value="Samoa" {{ $country == 'Samoa' ? 'selected' : '' }}>Samoa</option>
<option value="San Marino" {{ $country == 'San Marino' ? 'selected' : '' }}>San Marino</option>
<option value="Sao Tome and Principe" {{ $country == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
<option value="Saudi Arabia" {{ $country == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
<option value="Senegal" {{ $country == 'Senegal' ? 'selected' : '' }}>Senegal</option>
<option value="Serbia" {{ $country == 'Serbia' ? 'selected' : '' }}>Serbia</option>
<option value="Seychelles" {{ $country == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
<option value="Sierra Leone" {{ $country == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
<option value="Singapore" {{ $country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
<option value="Slovakia" {{ $country == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
<option value="Slovenia" {{ $country == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
<option value="Solomon Islands" {{ $country == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
<option value="Somalia" {{ $country == 'Somalia' ? 'selected' : '' }}>Somalia</option>
<option value="South Africa" {{ $country == 'South Africa' ? 'selected' : '' }}>South Africa</option>
<option value="South Korea" {{ $country == 'South Korea' ? 'selected' : '' }}>South Korea</option>
<option value="South Sudan" {{ $country == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
<option value="Spain" {{ $country == 'Spain' ? 'selected' : '' }}>Spain</option>
<option value="Sri Lanka" {{ $country == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
<option value="Sudan" {{ $country == 'Sudan' ? 'selected' : '' }}>Sudan</option>
<option value="Suriname" {{ $country == 'Suriname' ? 'selected' : '' }}>Suriname</option>
<option value="Sweden" {{ $country == 'Sweden' ? 'selected' : '' }}>Sweden</option>
<option value="Switzerland" {{ $country == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
<option value="Syria" {{ $country == 'Syria' ? 'selected' : '' }}>Syria</option>
<option value="Taiwan" {{ $country == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
<option value="Tajikistan" {{ $country == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
<option value="Tanzania" {{ $country == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
<option value="Thailand" {{ $country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
<option value="Timor-Leste" {{ $country == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
<option value="Togo" {{ $country == 'Togo' ? 'selected' : '' }}>Togo</option>
<option value="Tonga" {{ $country == 'Tonga' ? 'selected' : '' }}>Tonga</option>
<option value="Trinidad and Tobago" {{ $country == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
<option value="Tunisia" {{ $country == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
<option value="Turkey" {{ $country == 'Turkey' ? 'selected' : '' }}>Turkey</option>
<option value="Turkmenistan" {{ $country == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
<option value="Tuvalu" {{ $country == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
<option value="Uganda" {{ $country == 'Uganda' ? 'selected' : '' }}>Uganda</option>
<option value="Ukraine" {{ $country == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
<option value="United Arab Emirates" {{ $country == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
<option value="United Kingdom" {{ $country == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
<option value="United States" {{ $country == 'United States' ? 'selected' : '' }}>United States</option>
<option value="Uruguay" {{ $country == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
<option value="Uzbekistan" {{ $country == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
<option value="Vanuatu" {{ $country == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
<option value="Vatican City" {{ $country == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
<option value="Venezuela" {{ $country == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
<option value="Vietnam" {{ $country == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
<option value="Yemen" {{ $country == 'Yemen' ? 'selected' : '' }}>Yemen</option>
<option value="Zambia" {{ $country == 'Zambia' ? 'selected' : '' }}>Zambia</option>
<option value="Zimbabwe" {{ $country == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>