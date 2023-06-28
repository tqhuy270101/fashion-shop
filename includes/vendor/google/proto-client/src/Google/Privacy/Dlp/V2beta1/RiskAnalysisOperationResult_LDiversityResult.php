<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2beta1/dlp.proto

namespace Google\Privacy\Dlp\V2beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Result of the l-diversity computation.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2beta1.RiskAnalysisOperationResult.LDiversityResult</code>
 */
class RiskAnalysisOperationResult_LDiversityResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Histogram of l-diversity equivalence class sensitive value frequencies.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.RiskAnalysisOperationResult.LDiversityResult.LDiversityHistogramBucket sensitive_value_frequency_histogram_buckets = 5;</code>
     */
    private $sensitive_value_frequency_histogram_buckets;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2Beta1\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Histogram of l-diversity equivalence class sensitive value frequencies.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.RiskAnalysisOperationResult.LDiversityResult.LDiversityHistogramBucket sensitive_value_frequency_histogram_buckets = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSensitiveValueFrequencyHistogramBuckets()
    {
        return $this->sensitive_value_frequency_histogram_buckets;
    }

    /**
     * Histogram of l-diversity equivalence class sensitive value frequencies.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.RiskAnalysisOperationResult.LDiversityResult.LDiversityHistogramBucket sensitive_value_frequency_histogram_buckets = 5;</code>
     * @param \Google\Privacy\Dlp\V2beta1\RiskAnalysisOperationResult_LDiversityResult_LDiversityHistogramBucket[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSensitiveValueFrequencyHistogramBuckets($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Privacy\Dlp\V2beta1\RiskAnalysisOperationResult_LDiversityResult_LDiversityHistogramBucket::class);
        $this->sensitive_value_frequency_histogram_buckets = $arr;

        return $this;
    }

}

