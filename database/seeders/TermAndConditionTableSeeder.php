<?php

namespace Database\Seeders;

use App\Models\TermsAndCondition;
use Illuminate\Database\Seeder;

class TermAndConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermsAndCondition::create([
            'terms_and_condition' => '<div class="terms-conditions-page pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-wrap">
                            <div class="terms-top">
                                <h3>Terms Of Services &amp; Conditions</h3>
                                <p>For those of you who are serious
about having more, doing more, giving more and being more, success is
achievable with some understanding of what to do, some discipline around
 planning and execution of those plans and belief that you can achieve
your desires.</p>
                            </div>
                            <div class="terms-list">
                                <div class="single-terms">
                                    <h4>1. Your Registration Obligations</h4>
                                    <p>
                                        The best way is to develop and
follow a plan. Start with your goals in mind and then work backwards to
develop the plan. What steps are required to get you to the goals? Make
the plan as detailed as possible. Try to visualize and then plan for,
every possible setback. Commit the plan to paper and then keep it with
you at all times. Review it regularly and ensure that every step takes
you closer to your Vision and Goals. If the plan doesn’t support the
vision then change it!
                                    </p>
                                </div>
                                <div class="single-terms">
                                    <h4>2. User Account, Password, and Security</h4>
                                    <p>
                                        One of the main areas that I
work on with my clients is shedding these non-supportive beliefs and
replacing them with beliefs that will help them to accomplish their
desires.
                                    </p>
                                </div>
                                <div class="single-terms">
                                    <h4>3. User Conduct</h4>
                                    <p>
                                        I truly believe Augustine’s
words are true and if you look at history you know it is true. There are
 many people in the world with amazing talents who realize only a small
percentage of their potential. We all know people who live this truth.
                                    </p>
                                    <ul><li>Making a decision to do something </li><li>Focus is having the unwavering attention to complete what you set out to do.</li><li>Nothing changes until something moves </li><li>Commit your decision to paper</li><li>Execution is the single biggest factor in achievement</li></ul>
                                </div>
                                <div class="single-terms">
                                    <h4>4. International Use</h4>
                                    <p>
                                        The best way is to develop and
follow a plan. Start with your goals in mind and then work backwards to
develop the plan. What steps are required to get you to the goals? Make
the plan as detailed as possible. Try to visualize and then plan for,
every possible setback. Commit the plan to paper and then keep it with
you at all times. Review it regularly and ensure that every step takes
you closer to your Vision and Goals. If the plan doesn’t support the
vision then change it
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>'
        ]);
    }
}
