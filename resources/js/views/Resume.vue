<template>
    <div class="resume-view">
        <div class="container">
            <header>
                <h1 class="name">
                    Stevie McComb
                </h1>

                <h2 class="title">
                    Full-stack Web Developer
                </h2>

                <h3 class="website">
                    <a href="https://stevie.io" target="_blank">https://stevie.io</a>
                </h3>
            </header>

            <section class="contact-info">
                <h2>
                    Contact Information
                </h2>

                <ul class="ul">
                    <li>
                        <span class="fal fa-fw fa-phone"></span>
                        
                        <a href="tel:4356408857" target="_blank">
                            435.640.8857
                        </a>
                    </li>

                    <li>
                        <span class="fal fa-fw fa-envelope"></span>
                        
                        <a href="mailto:stevie.mccomb@gmail.com" target="_blank">
                            stevie.mccomb@gmail.com
                        </a>
                    </li>

                    <li>
                        <span class="fal fa-fw fa-map-pin"></span> Olympia, WA
                    </li>
                </ul>
            </section>

            <section class="notable-experience">
                <h2 class="mb-0">
                    Notable Experience
                </h2>

                <h3>
                    (in order of importance)
                </h3>

                <ul class="ul">
                    <li>
                        Created isolved University (<a href="https://learning.myisolved.com" target="_blank">learning.myisolved.com</a>), a custom Learning Management System (LMS) for training employees, partners, and customers in the usage of isolved's Human Capital Management (HCM) software. After a year of in-house usage, the LMS became a product sold directly to customers and partners. It currently serves more than 4,500 companies with over 150,000 concurrent users and a lifetime record of 1,500,000+ users.
                    </li>

                    <li>
                        Created Metrics Gym (<a href="https://www.metricsgym.com" target="_blank">metricsgym.com</a>), a SaaS application for comparing operational metrics of any business across any industry. Metrics Gym features vector-distance comparison between companies and an AI-powered analytics engine that can offer strategic operational advice to business owners based on their metrics and competition.
                    </li>

                    <li>
                        While working at Infinisource Inc., designed, developed, and maintained a custom Knowledge Base and B2B marketplace.
                    </li>

                    <li>
                        While working at RiSER (design agency), designed, developed, and maintained marketing websites, blogs, video games, and ad-campaigns for Google, ABC/Disney, National Geographic, Hulu, Kraft, Sony, FX, the American Numismatic Association, OrangeSoda, Crunchyroll, and more.
                    </li>

                    <li>
                        Taught general computer programming, web design, web development, and game development at the Art Institute of Salt Lake City in 2014 as an adjunct faculty member.
                    </li>

                    <li>
                        While working as a freelancer, designed, developed, and maintained numerous large-scale websites for local entrepreneurial clients from 2006 through 2013.
                    </li>

                    <li>
                        Worked in the hospitality industry for 8 years, learning the ins-and-outs of customer service and team-based communication.
                    </li>
                </ul>
            </section>

            <section class="education">
                <h2 class="mb-0">
                    Education
                </h2>

                <h3>
                    (in order of importance)
                </h3>

                <ul class="ul">
                    <li>Bachelor of Science in Web Design and Interactive Media, Art Institute of Salt Lake City, Spring 2014</li>

                    <li>Dean's List and Honor Roll, Art Institute of Salt Lake City, Winter 2013 &ndash; Spring 2014</li>

                    <li>Tutored for the following programs at the Art Institute of Salt Lake City from 2010 to 2014: Web Design and Interactive Media, Graphic Design, Audio Production, and Film Production.</li>

                    <li>Worked as adjunct professor at Art Institute of Salt Lake City after graduation.</li>
                </ul>
            </section>

            <section class="professional-interests">
                <h2 class="mb-0">
                    Specializations &amp; Interests
                </h2>

                <h3>
                    (in order of proficiency)
                </h3>

                <ul class="ul">
                    <li>
                        Full-stack Web Application Development
                    </li>

                    <li>
                        Marketing Web Development
                    </li>

                    <li>
                        Game Development
                    </li>

                    <li>
                        Mobile App Development
                    </li>
                </ul>
            </section>

            <section class="proficiencies">
                <h2 class="mb-0">
                    Software &amp; Language Proficiencies
                </h2>

                <h3>
                    (in no particular order)
                </h3>

                <ul class="ul">
                    <li>
                        <strong>
                            Programming Languages:
                        </strong>

                        HTML, CSS, JavaScript, PHP, SQL, Bash
                    </li>

                    <li>
                        <strong>
                            Frameworks &amp; Libraries
                        </strong>

                        Laravel, WordPress, Symfony, Vue, React, Svelte, Vite, Astro, Shopify
                    </li>

                    <li>
                        <strong>
                            Version Control:
                        </strong>

                        Git, Subversion, Mercurial, Perforce
                    </li>

                    <li>
                        <strong>
                            Design &amp; Content Software:
                        </strong>

                        Figma, Adobe Creative Suite (Photoshop, Illustrator, InDesign, AfterEffects, Premiere, Audition, etc.)
                    </li>

                    <li>
                        <strong>
                            Editors &amp; IDEs
                        </strong>

                        Visual Studio Code, PHPStorm, Sublime Text, JetBrains Rider
                    </li>

                    <li>
                        <strong>
                            Game Engines
                        </strong>

                        Godot, Unity, Unreal Engine, Phaser, Pixi
                    </li>
                </ul>
            </section>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    @import '~/master/variables';
    @import '~/master/mixins';

    .resume-view {
        flex: 1;
        padding-top: 2rem;
        background: darken(white, 10%);
        @include breakpoint-tablet {
            padding-top: 0;
        }
    }

    .container {
        max-width: calc(72ch + 4rem);
        background: white;
        padding: 2rem;
        border-radius: 0.25rem;
        margin-bottom: 2rem;
        @media print {
            max-width: 100%;
            border-radius: 0;
            margin-bottom: 0;
        }
    }

    h1, h2, h3, h4, h5, h6, p, li {
        max-width: 72ch;
    }

    h2 {
        font-size: 1.5rem;
    }

    h3 {
        font-size: 0.9rem;
        color: lighten(black, 32%);
    }

    header {
        text-align: center;
    }

    section {
        padding: 2rem 0;
        border-top: 1px solid darken(white, 24%);

        &:last-of-type {
            padding-bottom: 0;
        }
    }

    .name {
        font-size: 2rem;
    }

    .title {
        color: lighten(black, 32%);
        font-style: italic;
    }

    .website a {
        border-bottom: 0;
    }

    .contact-info li {
        display: flex;
        align-items: center;
        gap: 1rem;
        line-height: 1.5;

        .fal {
            color: red;
        }
    }

    .ul {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;

        &:last-child {
            margin-bottom: 0;
        }
    }

    li {
        margin-bottom: 0;
    }
</style>