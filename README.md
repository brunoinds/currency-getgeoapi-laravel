# PHP GetGeo Currency Exchange

A simple PHP library for exchanging currencies based on api.getgeoapi.com

<p align="center">
<a href="https://packagist.org/packages/brunoinds/currency-getgeo-api-laravel"><img src="https://img.shields.io/packagist/dt/brunoinds/currency-getgeo-api-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/brunoinds/currency-getgeo-api-laravel"><img src="https://img.shields.io/packagist/v/brunoinds/currency-getgeo-api-laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/brunoinds/currency-getgeo-api-laravel"><img src="https://img.shields.io/packagist/l/brunoinds/currency-getgeo-api-laravel" alt="License"></a>
</p>


## Installation

Install via Composer:

```bash
composer require brunoinds/currency-getgeo-api-laravel
```

## Configuration

Before using the library, you need to set up your GetGeo API key. Add the following to your `.env` file:

```env
CURRENCY_GETGEO_API_KEY=your_api_key_here
```

You can get your API key by signing up at [GetGeo API](https://api.getgeoapi.com/).

## Usage

The `Exchange` class provides methods for currency conversion:

```php
use Brunoinds\CurrencyGetGetApiLaravel\Exchange;
use Brunoinds\CurrencyGetGetApiLaravel\Enums\Currency;

// Get current exchange rate
$result = Exchange::now()->convert(Currency::USD, 100)->to(Currency::BRL);
echo $result; // e.g., 500.50

// Get historical exchange rate 
$date = new DateTime('2023-12-10');
$result = Exchange::on($date)
                ->convert(Currency::USD, 100)
                ->to(Currency::BRL);
echo $result; // e.g., 490.25

// Convert between any supported currencies
$result = Exchange::now()->convert(Currency::EUR, 50)->to(Currency::JPY);
echo $result; // e.g., 7500.00
```

## Caching

The library includes built-in caching to improve performance and reduce API calls. By default, it uses Laravel's cache system:

```php
use Brunoinds\CurrencyGetGetApiLaravel\Store\Store;

// Use custom store implementation
Exchange::useStore(new CustomStore());
```

The library automatically caches exchange rates to avoid repeated API calls for the same date and currency pair.

## Supported Currencies

The `Currency` enum provides constants for all supported currencies:

```php
use Brunoinds\CurrencyGetGetApiLaravel\Enums\Currency;

// Major currencies
Currency::USD;  // US Dollar
Currency::EUR;  // Euro
Currency::GBP;  // British Pound
Currency::JPY;  // Japanese Yen
Currency::CHF;  // Swiss Franc
Currency::CAD;  // Canadian Dollar
Currency::AUD;  // Australian Dollar
Currency::CNY;  // Chinese Yuan
Currency::BRL;  // Brazilian Real

// Other supported currencies include:
Currency::AFN;  // Afghan Afghani
Currency::ALL;  // Albanian Lek
Currency::DZD;  // Algerian Dinar
Currency::AOA;  // Angolan Kwanza
Currency::ARS;  // Argentine Peso
Currency::AMD;  // Armenian Dram
Currency::AWG;  // Aruban Florin
Currency::AZN;  // Azerbaijani Manat
Currency::BSD;  // Bahamian Dollar
Currency::BHD;  // Bahraini Dinar
Currency::BDT;  // Bangladeshi Taka
Currency::BBD;  // Barbadian Dollar
Currency::BYN;  // Belarusian Ruble
Currency::BZD;  // Belize Dollar
Currency::BMD;  // Bermudian Dollar
Currency::BTN;  // Bhutanese Ngultrum
Currency::BOB;  // Bolivian Boliviano
Currency::BAM;  // Bosnia and Herzegovina Convertible Mark
Currency::BWP;  // Botswana Pula
Currency::BND;  // Brunei Dollar
Currency::BGN;  // Bulgarian Lev
Currency::MMK;  // Burmese Kyat
Currency::BIF;  // Burundian Franc
Currency::XPF;  // CFP Franc
Currency::KHR;  // Cambodian Riel
Currency::CVE;  // Cape Verdean Escudo
Currency::KYD;  // Cayman Islands Dollar
Currency::XAF;  // Central African CFA Franc
Currency::CLP;  // Chilean Peso
Currency::COP;  // Colombian Peso
Currency::KMF;  // Comorian Franc
Currency::CDF;  // Congolese Franc
Currency::CRC;  // Costa Rican Colón
Currency::HRK;  // Croatian Kuna
Currency::CUC;  // Cuban Convertible Peso
Currency::CUP;  // Cuban Peso
Currency::CZK;  // Czech Koruna
Currency::DKK;  // Danish Krone
Currency::DJF;  // Djiboutian Franc
Currency::DOP;  // Dominican Peso
Currency::XCD;  // East Caribbean Dollar
Currency::EGP;  // Egyptian Pound
Currency::ERN;  // Eritrean Nakfa
Currency::ETB;  // Ethiopian Birr
Currency::FKP;  // Falkland Islands Pound
Currency::FJD;  // Fijian Dollar
Currency::GMD;  // Gambian Dalasi
Currency::GEL;  // Georgian Lari
Currency::GHS;  // Ghanaian Cedi
Currency::GIP;  // Gibraltar Pound
Currency::XAU;  // Gold (troy ounce)
Currency::GTQ;  // Guatemalan Quetzal
Currency::GGP;  // Guernsey Pound
Currency::GNF;  // Guinean Franc
Currency::GYD;  // Guyanese Dollar
Currency::HTG;  // Haitian Gourde
Currency::HNL;  // Honduran Lempira
Currency::HKD;  // Hong Kong Dollar
Currency::HUF;  // Hungarian Forint
Currency::ISK;  // Icelandic Króna
Currency::INR;  // Indian Rupee
Currency::IDR;  // Indonesian Rupiah
Currency::IRR;  // Iranian Rial
Currency::IQD;  // Iraqi Dinar
Currency::ILS;  // Israeli New Shekel
Currency::JMD;  // Jamaican Dollar
Currency::JEP;  // Jersey Pound
Currency::JOD;  // Jordanian Dinar
Currency::KZT;  // Kazakhstani Tenge
Currency::KES;  // Kenyan Shilling
Currency::KWD;  // Kuwaiti Dinar
Currency::KGS;  // Kyrgyzstani Som
Currency::LAK;  // Lao Kip
Currency::LBP;  // Lebanese Pound
Currency::LSL;  // Lesotho Loti
Currency::LRD;  // Liberian Dollar
Currency::LYD;  // Libyan Dinar
Currency::MOP;  // Macanese Pataca
Currency::MKD;  // Macedonian Denar
Currency::MGA;  // Malagasy Ariary
Currency::MWK;  // Malawian Kwacha
Currency::MYR;  // Malaysian Ringgit
Currency::MVR;  // Maldivian Rufiyaa
Currency::IMP;  // Manx Pound
Currency::MRU;  // Mauritanian Ouguiya
Currency::MUR;  // Mauritian Rupee
Currency::MXN;  // Mexican Peso
Currency::MDL;  // Moldovan Leu
Currency::MNT;  // Mongolian Tugrik
Currency::MAD;  // Moroccan Dirham
Currency::MZN;  // Mozambican Metical
Currency::NAD;  // Namibian Dollar
Currency::NPR;  // Nepalese Rupee
Currency::ANG;  // Netherlands Antillean Guilder
Currency::TWD;  // New Taiwan Dollar
Currency::NZD;  // New Zealand Dollar
Currency::NIO;  // Nicaraguan Córdoba
Currency::NGN;  // Nigerian Naira
Currency::NOK;  // Norwegian Krone
Currency::OMR;  // Omani Rial
Currency::PKR;  // Pakistani Rupee
Currency::PAB;  // Panamanian Balboa
Currency::PGK;  // Papua New Guinean Kina
Currency::PYG;  // Paraguayan Guarani
Currency::PEN;  // Peruvian Sol
Currency::PHP;  // Philippine Peso
Currency::PLN;  // Polish Złoty
Currency::QAR;  // Qatari Riyal
Currency::RON;  // Romanian Leu
Currency::RUB;  // Russian Ruble
Currency::RWF;  // Rwandan Franc
Currency::SHP;  // Saint Helena Pound
Currency::SVC;  // Salvadoran Colón
Currency::WST;  // Samoan Tala
Currency::SAR;  // Saudi Riyal
Currency::RSD;  // Serbian Dinar
Currency::SCR;  // Seychellois Rupee
Currency::SLE;  // Sierra Leonean Leone
Currency::SLL;  // Sierra Leonean Leone (old)
Currency::XAG;  // Silver (troy ounce)
Currency::SGD;  // Singapore Dollar
Currency::SBD;  // Solomon Islands Dollar
Currency::SOS;  // Somali Shilling
Currency::ZAR;  // South African Rand
Currency::KRW;  // South Korean Won
Currency::SSP;  // South Sudanese Pound
Currency::XDR;  // Special Drawing Rights
Currency::LKR;  // Sri Lankan Rupee
Currency::SDG;  // Sudanese Pound
Currency::SRD;  // Surinamese Dollar
Currency::SZL;  // Swazi Lilangeni
Currency::SEK;  // Swedish Krona
Currency::SYP;  // Syrian Pound
Currency::STN;  // São Tomé and Príncipe Dobra
Currency::TJS;  // Tajikistani Somoni
Currency::TZS;  // Tanzanian Shilling
Currency::USDT; // Tether
Currency::THB;  // Thai Baht
Currency::TOP;  // Tongan Paʻanga
Currency::TTD;  // Trinidad and Tobago Dollar
Currency::TND;  // Tunisian Dinar
Currency::TRY;  // Turkish Lira
Currency::TMT;  // Turkmenistani Manat
Currency::USDC; // USD Coin
Currency::UGX;  // Ugandan Shilling
Currency::UAH;  // Ukrainian Hryvnia
Currency::AED;  // United Arab Emirates Dirham
Currency::UYU;  // Uruguayan Peso
Currency::UZS;  // Uzbekistani Som
Currency::VUV;  // Vanuatu Vatu
Currency::VES;  // Venezuelan Bolívar Soberano
Currency::VND;  // Vietnamese Dong
Currency::XOF;  // West African CFA Franc
Currency::YER;  // Yemeni Rial
Currency::ZMW;  // Zambian Kwacha
Currency::ZWL;  // Zimbabwean Dollar
```

## Testing

Unit tests are located in the `tests` directory. Run tests with:

```
composer test
```

## Contributing

Pull requests welcome!

## Requirements

- PHP 8.1 or higher
- Laravel 8.0 or higher
- GetGeo API key

## License

MIT License

## Powered by:
- [GetGeo API](https://api.getgeoapi.com/)

## Author

**Bruno Freire**
- Email: brunoqm99@gmail.com
