<?php
namespace App\Models;
use Cache;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportResponse;
use Carbon\Carbon;
class AnalyticsFour {

  public static function getClient(){
    $client = new BetaAnalyticsDataClient([
      'credentials' => storage_path('app/analytics/service-account-credentials.json'),
    ]);
    return  $client;
  }

  public static function getProperty(string $property = NULL){
    switch($property){
      case 'main':
        $propertyID = env('MAIN_WEB_GA_ID');
        break;
      case 'collection':
        $propertyID = env('COLLECTION_WEB_GA_ID');
        break;
      default:
        $propertyID = env('MAIN_WEB_GA_ID');
    }
    return $propertyID;
  }

  public static function createPeriod(string $period = NULL){
    switch ($period) {
      case 'week':
        $start_date = Carbon::today()->subDays(7)->format('Y-m-d');
        break;
      case 'month':
        $start_date = Carbon::today()->subDays(30)->format('Y-m-d');
        break;
      case 'quarter':
        $start_date = Carbon::today()->subDays(91)->format('Y-m-d');
        break;
      case '6month':
        $start_date = Carbon::today()->subDays(182)->format('Y-m-d');
        break;
      case 'year':
        $start_date = Carbon::today()->subDays(365)->format('Y-m-d');
        break;
      default:
        $start_date = Carbon::today()->subDays(7)->format('Y-m-d');
    }
    return [ 'start_date' => $start_date, 'end_date' => 'today'];
  }

  public static function parseResults(RunReportResponse $response)
  {
    $results = array();
    foreach ($response->getRows() as $row) {
      $result = array();
      foreach ($row->getDimensionValues() as $dimensionValue) {
        $result['dimension'] = $dimensionValue->getValue();
      }
      foreach ($row->getMetricValues() as $metricValue) {
        $result['metric'] = $metricValue->getValue();
      }
      $results[] = $result;
    }
    return $results;
  }

  public static function fetchUserDevices( string $period = NULL, string $property = 'main')
  {
    $response = self::getClient()->runReport([
      'property' => 'properties/' . self::getProperty($property),
      'limit' => 10,
      'dateRanges' => [ new DateRange(self::createPeriod( $period ))],
      'dimensions' =>  [
        new Dimension(
          ['name' => 'deviceCategory']
        ),
      ],
      'metrics' =>  [ new Metric( ['name' => 'activeUsers'] ),]
      ]
    );
    return self::parseResults($response);
  }

  public static function fetchUsersByCountry(string $period = NULL, string $property = NULL ) {

    $response = self::getClient()->runReport(
      [
      'property' => 'properties/' . self::getProperty($property),
      'limit' => 100,
      'dateRanges' => [ new DateRange(self::createPeriod( $period ))],
      'dimensions' =>  [
        new Dimension(
          ['name' => 'country']
        ),
      ],
      'metrics' =>  [ new Metric( ['name' => 'activeUsers'] ) ]
      ]
    );
    return self::parseResults($response);
  }

  public static function fetchUserCounts( string $period = NULL, string $property = NULL)
  {
    $response = self::getClient()->runReport([
      'property' => 'properties/' . self::getProperty($property),
      'limit' => 10,
      'dateRanges'  =>  [ new DateRange(self::createPeriod( $period ))],
      'metrics'     =>  [ new Metric( ['name' => 'activeUsers'] ),]
      ]
    );
    return self::parseResults($response);
  }

  public static function fetchTopPages( string $period = NULL, string $property = NULL)
  {
    $response = self::getClient()->runReport([
      'property' => 'properties/' . self::getProperty($property),
      'limit' => 20,
      'dateRanges'  =>  [ new DateRange(self::createPeriod( $period ))],
      'dimensions' =>  [
        new Dimension(
          ['name' => 'fullPageUrl']
        ),
        new Dimension(
          ['name' => 'pageTitle']
        ),
      ],
      'metrics'     =>  [ new Metric( ['name' => 'activeUsers'] ),]
      ]
    );
    $results = array();
    foreach ($response->getRows() as $row) {
      $result = array();
      $dimensions  = $row->getDimensionValues();
      foreach ($dimensions as $dimensionValue) {
        $result['dimensions'][] = $dimensionValue->getValue();
      }
      foreach ($row->getMetricValues() as $metricValue) {
        $result['metric'] = $metricValue->getValue();
      }
      $results[] = $result;
    }
    return $results;
  }
}
